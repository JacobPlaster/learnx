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


import org.red5.logging.Red5LoggerFactory;
import org.red5.server.adapter.MultiThreadedApplicationAdapter;
import org.red5.server.api.IConnection;
import org.red5.server.api.scope.IScope;
import org.red5.server.api.stream.IBroadcastStream;
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
	String queryString;
	MysqlHandler mysqlHandler;
	
	String streamTag;

	/** {@inheritDoc} */
    @Override
	public synchronized boolean connect(IConnection conn, IScope scope, Object[] params) {
    	/*if (!super.connect(conn, scope, params))
           return false; */
    	
    	log.info("[STREAM - APPLICATION] connect");
		queryString = String.valueOf(conn.getConnectParams().get("queryString")); 
		
		// maybe check if max amount of connected users reached

    	return true;   
	}
    
    /** {@inheritDoc} */
    @Override
    public void streamPublishStart(IBroadcastStream stream) {
    	log.info("[STREAM - APPLICATION] streamPublishStart");
    	streamTag = stream.getPublishedName();
    	
    	// parse secret from query string
    	conn_secret_key = ServiceFunctions.parseQueryForSecret(queryString);
    	// no secret in query
    	if(conn_secret_key == null) this.rejectClient("No secret found.");
    	
    	mysqlHandler = new MysqlHandler();
    	// see if query secret matches secret in database
    	String databaseKey = mysqlHandler.getStreamKey(streamTag);
    	if(! conn_secret_key.equals(databaseKey))
    	{
    		this.rejectClient("Incorrect authentication details.");
    	}
    	// set state to online
    	mysqlHandler.setStreamState(streamTag, 1);
        super.streamPublishStart(stream);
    }
    
	/** {@inheritDoc} */
    @Override
	public void disconnect(IConnection conn, IScope scope) {
    	log.info("[STREAM - APPLICATION] disconnect");
    	// set state to offline
    	mysqlHandler.setStreamState(streamTag, 0);
		super.disconnect(conn, scope);
	}

}
