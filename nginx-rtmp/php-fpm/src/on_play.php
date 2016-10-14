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
  // maybe add (getStreamByTag and Increment into one)
  if ($stream_details != NULL)
  {
    // player is online
    if((int)$stream_details->state === 1)
    {
      // check if reached max number of viewers
      if($stream_details->numOfConnections <= $stream_details->maxConnections)
      {
        // update number of viewers
        $dm->incrementViewCount($stream_details->id);
        successful();
      } else {
        rejectCLient("Max viewer count reached.");
      }
    } else {
      rejectClient("Stream is offline.");
    }
  } else {
    rejectClient("Stream does not exist");
  }
?>
