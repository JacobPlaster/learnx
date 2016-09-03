package org.red5.core;

public class QueryStringParser {
	
	String query_secret = null;
	String query_password = null;
	
	/**
	 * Parses the given query string to extract values
	 */
	public QueryStringParser(String queryString)
	{
		// ?secret=02012012
		// ?user=admin&pwd=admin
		// current secret 02012012
		// remove question mark to show query
		queryString = queryString.substring(1);
		String[] elements = queryString.split("(=)|(&)|(/)");

		for(int i = 0; i < elements.length; i++)
		{
			// thne next item is going to be the secret
			if(elements[i].equals("secret") && elements.length > i+1)
			{
				this.query_secret = elements[i+1];
			} else if(elements[i].equals("pwd") && elements.length > i+1)
			{
				this.query_password = elements[i+1];
			}
		}
	}
	
	/***
	 * Returns the secret key in query string of the connection
	 * @return
	 */
	public String getSecret()
	{
		return this.query_secret;
	}
	/***
	 * Returns the password in query string of the connection
	 * @return
	 */
	public String getPassword()
	{
		return this.query_password;
	}

}
