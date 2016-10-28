<?php
require_once('cfg.php');

class DatabaseManager {
    // Tables
    private $USERS_TABLE = "users";
    private $STREAMS_VIDEO_TABLE = "stream_video";
    private $STREAMS_CHAT_TABLE = "stream_chat";

    private $conn = NULL;

    /**
     *
     * Connects the service to the mysql database
     *
     * @return The connection the mysql databse
     *
     */
    function connect()
    {
      // cfg.php
      global $SERVER_CFG;

      $server = $SERVER_CFG['MYSQL_HOST'].":".$SERVER_CFG['MYSQL_PORT'];
      $this->conn = new mysqli($server, $SERVER_CFG['MYSQL_USER'], $SERVER_CFG['MYSQL_PWD'], $SERVER_CFG['MYSQL_DATABSE_NAME']);
      if ($this->conn->connect_error) {
        die("Failed to connect to ".$server."  --  " . $this->conn->connect_error);
      }
      return $this->conn;
    }

    /**
     *
     * Disconnects the service from the mysqli connection
     *
     * @param    Secret stream key to identify user
     * @return   Null if stream doesnt exists and id of user if does
     *
     */
    function videoStreamKeyExists($key)
    {
      $query_string="SELECT id FROM ".$this->STREAMS_VIDEO_TABLE." WHERE stream_key='".$key."' LIMIT 1";
      $result=$this->conn->query($query_string)->fetch_object()->id;
      if(sizeof($result)>=1)
        return $result;
      else
        return NULL;
    }


    /**
     *
     * Gets the user data by its secure key
     *
     * @param users username
     *
     */
    function getStreamByKey($key)
    {
      $query_string="SELECT * FROM ".$this->STREAMS_VIDEO_TABLE." WHERE stream_key='".$key."' LIMIT 1";
      $result=$this->conn->query($query_string)->fetch_object();
      if(sizeof($result)>=1)
        return $result;
      else
        return NULL;
    }


    /**
     *
     * Gets the user data by its id tag (app name)
     *
     * @param users username
     *
     */
    function getStreamByTag($tag)
    {
      $query_string="SELECT * FROM ".$this->STREAMS_VIDEO_TABLE." WHERE tag='".$tag."' LIMIT 1";
      $result=$this->conn->query($query_string)->fetch_object();
      if(sizeof($result)>=1)
        return $result;
      else
        return NULL;
    }


    /**
     *
     * Sets the state of the stream
     *
     * @param The id of the targeted user
     * @param The state of the stream (1 = live, 0 = offline)
     *
     */
    function setStreamState($id, $state)
    {
      $query_string="UPDATE ".$this->STREAMS_VIDEO_TABLE." SET state='".$state."' WHERE id='".$id."'";
      $result = $this->conn->query($query_string);

      if(!$result){
        die('Error : ('. $mysqli->errno .') '. $mysqli->error);
      }
    }


    /**
     *
     * Updates the number of connections to the stream in the database (+1)
     *
     * @param The id of the targeted stream
     *
     */
    function incrementViewCount($id)
    {
      $query_string="UPDATE ".$this->STREAMS_VIDEO_TABLE." SET numOfConnections=numOfConnections+1 WHERE id='".$id."'";
      $result = $this->conn->query($query_string);

      if(!$result){
        die('Error : ('. $mysqli->errno .') '. $mysqli->error);
      }
    }


    /**
     *
     * Updates the number of connections to the stream in the database (-1)
     *
     * @param The id of the targeted stream
     *
     */
    function decrementViewCount($id)
    {
      $query_string="UPDATE ".$this->STREAMS_VIDEO_TABLE." SET numOfConnections=numOfConnections-1 WHERE id='".$id."'";
      $result = $this->conn->query($query_string);

      if(!$result){
        die('Error : ('. $mysqli->errno .') '. $mysqli->error);
      }
    }


    // add the video that being recorded to the database


    // get stream details
    // SELECT stream_key, id, user_id, recordable, numOfConnections, maxConnections FROM "+STREAMS_VIDEO_TABLE+" WHERE tag='"+tag+"' LIMIT 1


    // edge only (could connect to socket.io)
    // increment connections
    /*
    query = "UPDATE "+STREAMS_VIDEO_TABLE+" SET numOfConnections=numOfConnections+1 WHERE tag='"+tag+"'";
			else
				query = "UPDATE "+STREAMS_VIDEO_TABLE+" SET numOfConnections=numOfConnections-1 WHERE tag='"+tag+"'";
    */


    /**
     *
     * Disconnects the service from the mysqli connection
     *
     */
    function disconnect()
    {
      $this->conn->close();
    }


    function escape_string($string)
    {
      return mysqli_real_escape_string($this->conn, $string);
    }
}
?>
