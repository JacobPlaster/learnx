<?php

  function call404Error($message)
  {
    header('HTTP/1.1 404 Not Found');
    $_GET['e'] = 404;
    include $_SERVER['DOCUMENT_ROOT'].'/learnx-service/pages/error.php';
    exit;
  }

 ?>
