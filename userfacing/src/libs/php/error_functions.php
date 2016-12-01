<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php');

  function call404Error($message)
  {
    global $SERVER_PATH;
    //header('HTTP/1.1 404 Not Found');
    $_GET['e'] = 404;
    include($SERVER_PATH['inserts-error']);
    exit;
  }

  function call403Error($message)
  {
    global $SERVER_PATH;
    //header('HTTP/1.1 404 Not Found');
    $_GET['e'] = 403;
    include($SERVER_PATH['inserts-error']);
    exit;
  }

 ?>
