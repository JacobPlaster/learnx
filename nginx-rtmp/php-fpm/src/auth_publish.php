<?php

  /*
  echo($_GET['addr'] + "/n");
  echo($_GET['clientid'] + "/n");
  echo($_GET['app'] + "/n");
  echo($_GET['flashVer'] + "/n");
  echo($_GET['swfUrl'] + "/n");
  echo($_GET['tcUrl'] + "/n");
  echo($_GET['pageUrl'] + "/n");
  echo($_GET['name'] + "/n");
  */

  require_once('cfg.php');
  require_once('DatabaseManager.php');

  $conn_addr = $_GET['addr']; // ip address
  $conn_swfUrl = $_GET['swfurl']; // eg. rtmp://localhost:1935/encoder
  $conn_app = $_GET['app']; // eg. encoder

  if(empty($_GET['key']) || empty($_GET['name']))
  {
    //no querystrings or wrong syntax
    echo "wrong query input";
    header('HTTP/1.0 404 Not Found');
    exit(1);
  }

  // Update database and connect
  $dm = new DatabaseManager;
  $conn = $dm->connect();

  $stream_name = $_GET['name']; //mysql_real_escape_string($_GET['name']);
  $stream_key = $_GET['key']; // mysql_real_escape_string($_GET['key']);

  //check pass and user string
  //if (strcmp($password,$savedpassword)==0 &&  strcmp($username,$saveduser)==0 )
  if ($dm->videoStreamKeyExists($stream_key) != NULL)
  {
    echo "Password and Username OK!";
  }
  else
  {
    echo "Incorrect key";
    header('HTTP/1.0 404 Not Found'); //kein stream
  }


  $dm->disconnect();
?>
