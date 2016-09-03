package org.red5.core;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Statement;

import javax.sql.DataSource;

import com.mysql.jdbc.jdbc2.optional.MysqlDataSource;

public class MysqlHandler {
	
	private String STREAMS_VIDEO_TABLE = "stream_video";
	private String SAVED_VIDEO_TABLE = "saved_video";
	
	private int stream_id = 0;
	private int user_id = 0;
	private String streamKey = null;
	private String password = null;
	private boolean isRecordable = false;
	private int numOfConnections = 0;
	private int maxConnections = 0;
	
	public static DataSource getMYSQLDataSource()
	{
		MysqlDataSource mysqld = null;
		try
		{
			mysqld = new MysqlDataSource();
			mysqld.setUrl("jdbc:mysql://localhost:3306/learnx");
			mysqld.setUser("root");
			mysqld.setPassword("root");
		} catch( Exception e )
		{
			e.printStackTrace();
		}
		return mysqld;
	}
	
	/***
	 * Uses the tag to locate the details of the stream
	 * @param tag
	 */
	public void getStreamDetails(String tag)
	{
		Connection conn = null;
		Statement stmt = null;
		DataSource dataSource = this.getMYSQLDataSource();
		try
		{
			conn = dataSource.getConnection();
			// query
			stmt = conn.createStatement();
			String query = "SELECT stream_key, id, user_id, password, recordable, numOfConnections, maxConnections FROM "+STREAMS_VIDEO_TABLE+" WHERE tag='"+tag+"' LIMIT 1";
			ResultSet rs = stmt.executeQuery(query);
			// get results 
			while(rs.next())
			{
				this.streamKey = rs.getString("stream_key");
				this.stream_id = rs.getInt("id");
				this.user_id = rs.getInt("user_id");
				if(rs.getInt("recordable") == 1)
					this.isRecordable = true;
				this.numOfConnections = rs.getInt("numOfConnections");
				this.maxConnections = rs.getInt("maxConnections");
				
				String tmpPassword = rs.getString("password");
				if(tmpPassword != "" && tmpPassword != null && tmpPassword.length() > 2)
					this.password = tmpPassword;
				
			}
			rs.close();
			
		} catch( Exception e )
		{
			e.printStackTrace();
		} finally
		{
			try
			{
				if(conn != null)
					conn.close();
			} catch( Exception e )
			{
				e.printStackTrace();
			}
		}
	}
	
	/***
	 * Increments the number of connections, unless inc is set to false. In Which case, the value is decremented
	 * @param tag
	 * @param state
	 */
	public void incrementNumOfConnections(String tag, boolean inc)
	{
		Connection conn = null;
		Statement stmt = null;
		DataSource dataSource = this.getMYSQLDataSource();
		try
		{
			conn = dataSource.getConnection();
			stmt = conn.createStatement();
			// change state to online (streaming)
			String query;
			if(inc)
				query = "UPDATE "+STREAMS_VIDEO_TABLE+" SET numOfConnections=numOfConnections+1 WHERE tag='"+tag+"'";
			else
				query = "UPDATE "+STREAMS_VIDEO_TABLE+" SET numOfConnections=numOfConnections-1 WHERE tag='"+tag+"'";
			int rs = stmt.executeUpdate(query);
			
		} catch( Exception e )
		{
			e.printStackTrace();
		} finally
		{
			try
			{
				if(conn != null)
					conn.close();
			} catch( Exception e )
			{
				e.printStackTrace();
			}
		}
	}
	
	/***
	 * Sets the state of the stream (example 1 = online, 0 = offline)
	 * @param tag
	 * @param state
	 */
	public void setStreamState(String tag, int state)
	{
		Connection conn = null;
		Statement stmt = null;
		DataSource dataSource = this.getMYSQLDataSource();
		try
		{
			conn = dataSource.getConnection();
			stmt = conn.createStatement();
			// change state to online (streaming)
			String query = "UPDATE "+STREAMS_VIDEO_TABLE+" SET state='"+state+"' WHERE tag='"+tag+"'";
			int rs = stmt.executeUpdate(query);
			
		} catch( Exception e )
		{
			e.printStackTrace();
		} finally
		{
			try
			{
				if(conn != null)
					conn.close();
			} catch( Exception e )
			{
				e.printStackTrace();
			}
		}
	}
	
	/***
	 * Adds the video the being recorded to the main database
	 * @param filename
	 */
	public void addNewVideo(String filename)
	{
		Connection conn = null;
		Statement stmt = null;
		DataSource dataSource = this.getMYSQLDataSource();
		try
		{
			conn = dataSource.getConnection();
			stmt = conn.createStatement();
			// change state to online (streaming)
			String query = "INSERT INTO `"+SAVED_VIDEO_TABLE+"`(`stream_video_id`, `user_id`, `filename`) VALUES ('"+stream_id+"','"+user_id+"','"+filename+"')";
			int rs = stmt.executeUpdate(query);
			
		} catch( Exception e )
		{
			e.printStackTrace();
		} finally
		{
			try
			{
				if(conn != null)
					conn.close();
			} catch( Exception e )
			{
				e.printStackTrace();
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	/***
	 * returns the stream key
	 * @param tag
	 * @return
	 */
	public String getStreamKey()
	{
		return streamKey;
	}
	
	/**
	 * Returns false if the stream does not support recording
	 * @return
	 */
	public boolean getRecordable()
	{
		return isRecordable;
	}
	
	/***
	 * Returns the id of the stream
	 * @return
	 */
	public int getStreamId()
	{
		return this.stream_id;
	}
	
	/***
	 * returns the password of the stream (Null if not set)
	 * @return
	 */
	public String getPassword()
	{
		return this.password;
	}
	
	/***
	 * Returns the id of the user
	 * @return
	 */
	public int getUserId()
	{
		return this.user_id;
	}
	
	/***
	 * Returns the number of connections to the stream
	 * @return
	 */
	public int getNumOfConnections()
	{
		return this.numOfConnections;
	}
	
	/***
	 * Returns the maximum number of connections to the stream
	 * @return
	 */
	public int getMaxConnections()
	{
		return this.maxConnections;
	}
}
