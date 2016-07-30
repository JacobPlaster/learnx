package org.red5.core;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Statement;

import javax.sql.DataSource;

import com.mysql.jdbc.jdbc2.optional.MysqlDataSource;

public class MysqlHandler {
	
	private String STREAMS_VIDEO_TABLE = "stream_video";
	
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
	
	// check if allowed to connect to stream tag
	public String getStreamKey(String tag)
	{
		Connection conn = null;
		Statement stmt = null;
		DataSource dataSource = this.getMYSQLDataSource();
		String streamKey = null;
		try
		{
			conn = dataSource.getConnection();
			// query
			stmt = conn.createStatement();
			String query = "SELECT stream_key FROM "+STREAMS_VIDEO_TABLE+" WHERE tag='"+tag+"' LIMIT 1";
			ResultSet rs = stmt.executeQuery(query);
			// get results 
			while(rs.next())
			{
				streamKey = rs.getString("stream_key");
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
		return streamKey;
	}
	
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
}
