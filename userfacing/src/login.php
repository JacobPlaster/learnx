<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php');
if($SERVER_CFG['REDIS_ENABLED'] == true)
  include $SERVER_PATH['libs-php'].'/redis.php';
require_once($SERVER_PATH['libs-php'].'/DatabaseManager.php');

session_start();

// Update database and connect
$dm = new DatabaseManager;
$conn = $dm->connect();

$errors = array();

if (isset($_POST['submit-login'])) {
    $username = $dm->escape_string($_POST['username']);
    $password = $dm->escape_string($_POST['password']);
    $user = $dm->getUserByUsername($username);

    if($user != NULL)
    {
      $encrypt_pass = sha1($password.$user->salt);
      if($encrypt_pass == $user->password)
      {
        // sucess
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;
        header('Location: /user/dashboard.php');
      } else {
        array_push($errors, "Username or password incorrect.");
      }
    } else {
      array_push($errors, "Username or password incorrect.");
    }
    // get salt and password
    // if match when encrypted then go
}
elseif (isset($_POST['submit-register']))
{
  $pass1 = $_POST['password1'];
  $pass2 = $_POST['password2'];
  // no errors, process registration
  $username = $dm->escape_string($_POST['username']);
  $email = $dm->escape_string($_POST['email']);
  $pass1 = $dm->escape_string($pass1);
  $pass2 = $dm->escape_string($pass2);

  // check if passwords match
  if($pass1 != $pass2)
  {
    array_push($errors, "Password does not match re-typed password.");
  }
  // check if username taken
  if($dm->usernameExists($username) != NULL)
  {
    array_push($errors, "Username is already in use.");
  }
  // check if email in use
  if($dm->emailExists($email) != NULL)
  {
    array_push($errors, "Email address is already in use.");
  }


  // success
  if(sizeof($errors) == 0)
  {
    $dm->addNewUser($username, $pass1, $email);
      header('Location: /user/dashboard.php');
  }
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
        foreach($errors as &$error)
        {
          echo("<h5>".$error."</h5>");
        }
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
