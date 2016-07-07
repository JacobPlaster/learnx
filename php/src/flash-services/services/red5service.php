<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/learnx-service/DatabaseManager.php');

class red5service
{
  function  Red5Service()
  {
    $this->methodTable = array(
    "DisconnectStream" => array(
    "description" => "Disconnects stream and updates database",
    "access" => "remote",
    "arguments" => array ("ScretKey to identify stream")
    ),
    "AuthenticateAndInitialise" => array(
    "description" => "Authenticates stream key and then updates the database",
    "access" => "remote",
    "arguments" => array ("StreamKey to identify stream")
    )
    );
  }

  function DisconnectStream($StreamKey)
  {
    // Update database and connect
    $dm = new DatabaseManager;
    $conn = $dm->connect();

    // Check if valid stream key
    $userId = $dm->StreamKeyExists($StreamKey);
    if($userId == NULL)
      return false;
    $dm->removeStream($userId);

    $dm->disconnect();


    return true;
  }

  function AuthenticateAndInitialise($StreamKey)
  {
    // Update database and connect
    $dm = new DatabaseManager;
    $conn = $dm->connect();

    // Check if valid stream key
    $userId = $dm->StreamKeyExists($StreamKey);
    $username = $dm->getUsernameByID($userId);
    if($userId == NULL)
      return "404";

    $dm->addNewStream($userId, "test", "test.php", "0");

    $dm->disconnect();
    return $username;
  }
}
?>
