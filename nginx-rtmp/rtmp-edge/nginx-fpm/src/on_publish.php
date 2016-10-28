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

  if(empty($_GET['key']) || empty($_GET['name'])) // later add app and addr
  {
    header('HTTP/1.0 404 Not Found');
    exit();
  }

  // Update database and connect
  $dm = new DatabaseManager;
  $conn = $dm->connect();

  $stream_name = $dm->escape_string($_GET['name']); //mysql_real_escape_string($_GET['name']);
  $stream_key = $dm->escape_string($_GET['key']); // mysql_real_escape_string($_GET['key']);

  // Pull all data from stream
  $stream_details = $dm->getStreamByKey($stream_key);
  if ($stream_details != NULL)
  {
    if($stream_details->tag === $stream_name)
    {
      // success
      // set to live
      $dm->setStreamState($stream_details->id, 1);
      successful();
    } else {
      rejectClient("stream tag doesnt match");
    }
  }
  else
  {
    rejectClient("Stream doesnt exist");
  }


  function rejectClient($report)
  {
    global $dm;

    echo "Incorrect stream details";
    echo ": <br>".$report;
    header('HTTP/1.0 404 Not Found');
    $dm->disconnect();
    exit();
  }
  function successful()
  {
    global $dm;

    echo "Stream authentication OK";
    $dm->disconnect();
  }
?>
