<?php

  require_once('cfg.php');
  require_once('DatabaseManager.php');

  function rejectClient($report)
  {
    echo "Incorrect stream details";
    echo "<br>".$report."<br>";
    header('HTTP/1.0 404 Not Found');
    $dm->disconnect();
    exit();
  }
  function successful()
  {
    echo "OK";
    $dm->disconnect();
  }

  $conn_addr = $_GET['addr']; // ip address
  $conn_swfUrl = $_GET['swfurl']; // eg. rtmp://localhost:1935/encoder
  $conn_app = $_GET['app']; // eg. encoder

  // Update database and connect
  $dm = new DatabaseManager;
  $conn = $dm->connect();


  $stream_tag = $dm->escape_string($_GET['name']); // mysql_real_escape_string($_GET['key']);
  // Pull all data from stream
  $stream_details = $dm->getStreamByTag($stream_tag);
  // set to offline
  $dm->setStreamState($stream_details->id, 0);
?>
