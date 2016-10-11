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
     * Disconnects the service from the mysqli connection
     *
     */
    function disconnect()
    {
      $this->conn->close();
    }
}
?>
