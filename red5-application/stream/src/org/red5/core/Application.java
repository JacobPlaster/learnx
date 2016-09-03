package org.red5.core;

/*
 * RED5 Open Source Flash Server - http://www.osflash.org/red5
 * 
 * Add jars:
 * 	- libs/red5-server-common
 * 	- red5-server
 *  - red5-service
 *  - libs/slf4j-api
 */


import java.util.UUID;

import org.red5.logging.Red5LoggerFactory;
import org.red5.server.adapter.MultiThreadedApplicationAdapter;
import org.red5.server.api.IConnection;
import org.red5.server.api.scope.IScope;
import org.red5.server.api.stream.IBroadcastStream;
import org.red5.server.api.stream.IPlayItem;
import org.red5.server.api.stream.ISubscriberStream;
import org.slf4j.Logger;

/**
 * Sample application that uses the client manager.
 * 
 * @author The Red5 Project (red5@osflash.org)
 */
public class Application extends MultiThreadedApplicationAdapter{
	
	// Handle logs
	private static Logger log = Red5LoggerFactory.getLogger(Application.class);
	RemoteServerHandler rHandler;
	String conn_secret_key;
	String conn_password;
	String queryString;
	MysqlHandler mysqlHandler;
	
	String streamTag;
	IConnection main_conn;
	IScope main_scope;
	
	
	// Fired when ANY connection connects (rtmp and client player)
	/** {@inheritDoc} */
    @Override
	public synchronized boolean connect(IConnection conn, IScope scope, Object[] params) {
    	/*if (!super.connect(conn, scope, params))
           return false; */
    	this.main_conn = conn;
    	this.main_scope = scope;
    	log.info("[STREAM - APPLICATION] connect");
		queryString = String.valueOf(conn.getConnectParams().get("queryString")); 
		// parse secret from query string
		QueryStringParser qp = new QueryStringParser(queryString);
    	conn_secret_key = qp.getSecret();
    	conn_password = qp.getPassword();
    	log.info("Main conn params: " + queryString);
		
		// maybe check if max amount of connected users reached

    	return true;   
	}
    
    
    // fired when the user plays the stream via a player
    /** {@inheritDoc} */
    @Override
    public void streamPlayItemPlay(ISubscriberStream stream, IPlayItem item, boolean isLive) {
    	log.info("[STREAM - APPLICATION] streamPlayItemPlay");
    	
    	// get the number of connections to the stream
    	// if is equal or more than max - leave
    	streamTag = stream.getBroadcastStreamPublishName();
    	mysqlHandler = new MysqlHandler();
    	// need to add to db, otherwise disconnect will put it into negative figures
    	mysqlHandler.incrementNumOfConnections(streamTag, true);
    	// load stream details
    	mysqlHandler.getStreamDetails(streamTag);
    	

    	// check if passworded stream
    	String stream_password = mysqlHandler.getPassword();
    	// if stream has a password
    	if(stream_password != null)
    	{
    		// if password does not match with the password given in the query string
    		if(!stream_password.equals(conn_password))
    		{
    			// too many clients connected, reject
        		//this.rejectClient(); for some reason, reject isnt enough for a viewer client
        		this.disconnect(this.main_conn, this.main_scope);
        		this.main_conn.close();
    		}
    	}
    	
    	
    	// Check if stream exceeds max allowed connections
    	int numOfCons = mysqlHandler.getNumOfConnections();
    	if(numOfCons > mysqlHandler.getMaxConnections())
    	{
    		// too many clients connected, reject
    		//this.rejectClient(); for some reason, reject isnt enough for a viewer client
    		this.disconnect(this.main_conn, this.main_scope);
    		this.main_conn.close();
    	}
    }
    
    
    
    // fired when the user connects an rtmp signal
    /** {@inheritDoc} */
    @Override
    public void streamBroadcastStart(IBroadcastStream stream) {
    	log.info("[STREAM - APPLICATION] streamBroadcastStart");
    	
    	streamTag = stream.getPublishedName();
    	// no secret in query
    	if(conn_secret_key == null) this.rejectClient("No secret found.");
    	
    	mysqlHandler = new MysqlHandler();
    	mysqlHandler.incrementNumOfConnections(streamTag, true);
    	// load stream details
    	mysqlHandler.getStreamDetails(streamTag);
    	// see if query secret matches secret in database
    	String databaseKey = mysqlHandler.getStreamKey();
    	if(!conn_secret_key.equals(databaseKey))
    	{
    		this.rejectClient("Incorrect authentication details.");
    	}
    	
    	// if the stream supports recording 
    	if(mysqlHandler.getRecordable())
    	{
	    	// begin recording stream
	    	String streamFileName = mysqlHandler.getUserId() + mysqlHandler.getStreamId() + UUID.randomUUID().toString().replace("-", "");
	    	// make sure string is 16 chars
	    	streamFileName = streamFileName.substring(0, 16);
	    	try
	    	{
	    		log.info("Starting to record "+stream.getPublishedName()+", saved as: " + streamFileName + ".flv");
	    		mysqlHandler.addNewVideo(streamFileName);
	    		stream.saveAs(streamFileName, false);
	    	} catch (Exception e)
	    	{
	    		log.error("Error while saving stream: " + streamFileName);
	    		e.printStackTrace();
	    	}
    	}
    	// set state to online.
    	mysqlHandler.setStreamState(streamTag, 1);
    }
    
    
    
    // fired when the connected rtmp signal disconnects
    /** {@inheritDoc} */
    @Override
    public void streamBroadcastClose(IBroadcastStream stream)  {
    	log.info("[STREAM - APPLICATION] streamPublishClose");
    	// set state to offline
    	mysqlHandler.setStreamState(streamTag, 0);
    }
    
    
    
    // fired when ANY connection disconnects (both client and rtmp)
	/** {@inheritDoc} */
    @Override
	public void disconnect(IConnection conn, IScope scope) {
    	log.info("[STREAM - APPLICATION] disconnect");
    	mysqlHandler.incrementNumOfConnections(streamTag, false);
		super.disconnect(conn, scope);
	}

}
