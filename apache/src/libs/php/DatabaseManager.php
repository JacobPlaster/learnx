<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php');

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
      $query_string="SELECT id FROM ".$this->USERS_TABLE." WHERE stream_key='".$key."' LIMIT 1";
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
     * @param    Secret stream key to identify user
     * @return   Null if stream doesnt exists and id of user if does
     *
     */
    function videoStreamTagExists($tag)
    {
      $query_string="SELECT user_id FROM ".$this->STREAMS_VIDEO_TABLE." WHERE tag='".$tag."' LIMIT 1";
      $result=$this->conn->query($query_string)->fetch_object()->user_id;
      if(sizeof($result)>=1)
        return $result;
      else
        return NULL;
    }

    /**
     *
     * Disconnects the service from the mysqli connection
     *
     * @param    Secret stream key to identify user
     * @return   Null if stream doesnt exists and id of user if does
     *
     */
    function chatStreamTagExists($tag)
    {
      $query_string="SELECT user_id FROM ".$this->STREAMS_CHAT_TABLE." WHERE tag='".$tag."' LIMIT 1";
      $result=$this->conn->query($query_string)->fetch_object()->user_id;
      if(sizeof($result)>=1)
        return $result;
      else
        return NULL;
    }

    /**
     *
     * Checks if the username already exists in the database
     *
     * @param    Users username
     * @return   Null if does not exists else returns id
     *
     */
    function usernameExists($username)
    {
      $query_string="SELECT id FROM ".$this->USERS_TABLE." WHERE username='".$username."' LIMIT 1";
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
    function addNewVideoStream($user_id, $tag, $title, $description, $stream_key)
    {
      $title = $this->conn->real_escape_string($title);
      $description = $this->conn->real_escape_string($description);
      $query_string = "INSERT INTO ".$this->STREAMS_VIDEO_TABLE."
      (user_id, tag, title, description, stream_key)
      VALUES ('$user_id', '$tag', '$title', '$description', '$stream_key')";
      $result = $this->conn->query($query_string);
      if(!$result){
        echo($query_string);
        die('Error : ('. $this->conn->errno .') '. $this->conn->error);
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
    function addNewChatStream($user_id, $tag)
    {
      $query_string = "INSERT INTO ".$this->STREAMS_CHAT_TABLE."
      (user_id, tag)
      VALUES ('$user_id', '$tag')";
      $result = $this->conn->query($query_string);
      if(!$result){
        echo($query_string);
        die('Error : ('. $this->conn->errno .') '. $this->conn->error);
      }
    }

    /**
     *
     * Adds a new user to the database
     *
     * @param The username of the user
     * @param The users password
     * @param The users email
     *
     */
    function addNewUser($username, $password, $email)
    {
      $query_string = "INSERT INTO ".$this->USERS_TABLE."
      (username, password, email)
      VALUES ('$username', '$password', '$email')";
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
     * Returns all live streams
     *
     */
    function getAllLiveVideoStreams()
    {
      $results = array();
      $ids = $this->conn->query("SELECT user_id, title, description, tag FROM ".$this->STREAMS_VIDEO_TABLE."");
      while($row= $ids->fetch_object()) {
        $user = $this->conn->query("SELECT username FROM ".$this->USERS_TABLE." WHERE id='".$row->user_id."'")->fetch_object();
        $item = array("id"=>$row->user_id, "username"=>$user->username, "title"=>$row->title, "description"=>$row->title, "tag"=>$row->tag);
        array_push($results, $item);
      }
      return $results;
    }


    /**
     *
     * Returns all online live streams
     *
     */
    function getAllOnlineLiveVideoStreams()
    {
      $results = array();
      $ids = $this->conn->query("SELECT user_id, title, description, tag FROM ".$this->STREAMS_VIDEO_TABLE." WHERE state='1'");
      while($row= $ids->fetch_object()) {
        $user = $this->conn->query("SELECT username FROM ".$this->USERS_TABLE." WHERE id='".$row->user_id."'")->fetch_object();
        $item = array("id"=>$row->user_id, "username"=>$user->username, "title"=>$row->title, "description"=>$row->title, "tag"=>$row->tag);
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
      $query_string="SELECT title, description, tag FROM ".$this->STREAMS_VIDEO_TABLE." WHERE user_id='".$user_id."' LIMIT 1";
      $result=$this->conn->query($query_string)->fetch_array();
      if(sizeof($result)>=1)
        return $result;
      else
        return NULL;
    }

    /**
     *
     * Returns stream associated with given user id
     *
     * @param users id
     *
     */
    function getStreamByTag($tag)
    {
      $query_string="SELECT title, description, user_id FROM ".$this->STREAMS_VIDEO_TABLE." WHERE tag='".$tag."' LIMIT 1";
      $result=$this->conn->query($query_string)->fetch_array();
      if(sizeof($result)>=1)
        return $result;
      else
        return NULL;
    }


    /**
     *
     * Returns all user id's
     *
     * @param users id
     *
     */
    function getAllUserIDs()
    {
      $query_string="SELECT id FROM ".$this->USERS_TABLE." ";
      $result=$this->conn->query($query_string);
      $rows = array();
      while($row = $result->fetch_assoc()){
          $rows[] = $row;
      }
      return $rows;
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
     * Gets the id of the user that owns the stream via the streams tag
     *
     * @param users username
     *
     */
    function getVideoStreamOwner($user_id)
    {
      $query_string="SELECT id, username, email FROM ".$this->USERS_TABLE." WHERE id='".$user_id."' LIMIT 1";
      $result=$this->conn->query($query_string)->fetch_object();
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
