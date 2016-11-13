<?php

  require_once('cfg.php');
  require_once('DatabaseManager.php');

  $name = $_GET['name'];

  header("HTTP/1.1 300");
  header("Location: rtmp://138.68.131.239:1935/origin/".$name);
 ?>
