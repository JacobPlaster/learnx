<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php');
include $SERVER_PATH['libs-php'].'/redis.php';

session_start();

if (isset($_POST['submit-login'])) {
    $_SESSION['username'] = $_POST['username'];
}
elseif (isset($_POST['submit-register']))
{
  $_SESSION['username'] = $_POST['username'];
}
?>


<html class="no-js" lang="">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Login</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php include($SERVER_PATH['inserts-header-libs']); ?>
  </head>
  <body>
    <?php
      // user not logged in
      if(!isset($_SESSION['username']))
      {
        include($SERVER_PATH['inserts-loginreg-form']);
      // user logged in
      } else {
        echo("
        <div class='modal-content'>
          <h3>Logged in as:".$_SESSION['username']."</h3><br>
          <a href='/logout.php'>Log out?</a>
        </div> ");
      }
     ?>
  </body>
</html>
