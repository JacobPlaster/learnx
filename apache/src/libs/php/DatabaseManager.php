<?php
class DatabaseManager {
    // Tables
    private $USERS_TABLE = "users";
    private $STREAMS_VIDEO_TABLE = "stream_video";

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
    function StreamKeyExists($StreamKey)
    {
      $query_string="SELECT id FROM ".$this->USERS_TABLE." WHERE stream_key='".$StreamKey."' LIMIT 1";
      $result=$this->conn->query($query_string)->fetch_object()->id;
      if(sizeof($result)>=1)
        return $result;
      else
        return NULL;
    }

    /**
     *
     * Sets the state of the users stream
     *
     * @param The id of the targeted user
     * @param The state of the stream (1 = live, 0 = offline)
     *
     */
    function SetUserStreamState($id, $state)
    {
      $query_string="UPDATE ".$this->USERS_TABLE." SET stream_state='".$state."' WHERE id='".$id."'";
      $result = $this->conn->query($query_string);

      if(!$result){
        die('Error : ('. $mysqli->errno .') '. $mysqli->error);
      }
    }

    /**
     *
     * Adds a new item into the stream table which details the new incoming stream
     *
     * @param The id of the targeted user
     * @param The title of the stream
     * @param The description of the stream
     * @param The category that the stream realtes to
     *
     */
    function addNewStream($user_id, $title, $description, $category_id)
    {
      $title = $this->conn->real_escape_string($title);
      $description = $this->conn->real_escape_string($description);
      $query_string = "INSERT INTO ".$this->STREAMS_VIDEO_TABLE."
      (user_id, title, description, category_id)
      VALUES ('$user_id', '$title', '$description', '$category_id')";
      $result = $this->conn->query($query_string);
      if(!$result){
        die('Error : ('. $this->conn->errno .') '. $this->conn->error);
      }
    }

    /**
     *
     * Removes the online stream related to the given user id
     *
     * @param The id of the targeted user
     *
     */
    function removeStream($user_id)
    {
      //MySqli Delete Query
      $query_string = "DELETE FROM ".$this->STREAMS_VIDEO_TABLE." WHERE user_id='$user_id'";
      $result = $this->conn->query($query_string);

      if(!$results){
        die('Error : ('. $this->conn->errno .') '. $this->conn->error);
      }
    }


    /**
     *
     * Returns all currenlty live streams
     *
     */
    function getAllLiveStreams()
    {
      $results = array();
      $ids = $this->conn->query("SELECT user_id, title, description FROM ".$this->STREAMS_VIDEO_TABLE."");
      while($row= $ids->fetch_object()) {
        $user = $this->conn->query("SELECT username FROM ".$this->USERS_TABLE." WHERE id='".$row->user_id."'")->fetch_object();
        $item = array("id"=>$row->user_id, "username"=>$user->username, "title"=>$row->title, "description"=>$row->title);
        array_push($results, $item);
      }
      return $results;
    }


    /**
     *
     * Returns stream associated with given user id
     *
     * @param users id
     *
     */
    function getStreamByID($user_id)
    {
      $query_string="SELECT title, description, category_id FROM ".$this->STREAMS_VIDEO_TABLE." WHERE user_id='".$user_id."' LIMIT 1";
      $result=$this->conn->query($query_string)->fetch_array();
      if(sizeof($result)>=1)
        return $result;
      else
        return NULL;
    }



    /**
     *
     * Gets the user related to the given id
     *
     * @param The id of the targeted user
     *
     */
    function getUsernameByID($user_id)
    {
      $query_string="SELECT username FROM ".$this->USERS_TABLE." WHERE id='".$user_id."' LIMIT 1";
      $result=$this->conn->query($query_string)->fetch_object()->username;
      if(sizeof($result)>=1)
        return $result;
      else
        return NULL;
    }

    /**
     *
     * Gets the id of the user
     *
     * @param users username
     *
     */
    function getUserIDByUsername($user_id)
    {
      $query_string="SELECT id FROM ".$this->USERS_TABLE." WHERE username='".$user_id."' LIMIT 1";
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
