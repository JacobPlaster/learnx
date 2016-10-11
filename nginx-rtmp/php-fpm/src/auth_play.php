<?php

  /*
  echo($_GET['all'] + "/n");
  echo($_GET['addr'] + "/n");
  echo($_GET['clientid'] + "/n");
  echo($_GET['app'] + "/n");
  echo($_GET['flashVer'] + "/n");
  echo($_GET['swfUrl'] + "/n");
  echo($_GET['tcUrl'] + "/n");
  echo($_GET['pageUrl'] + "/n");
  echo($_GET['name'] + "/n");
  */

  //check if querystrings exist or not
  if(empty($_GET['user']) || empty($_GET['pass']))
  {
    //no querystrings or wrong syntax
    echo "wrong query input";
    header('HTTP/1.0 404 Not Found');
    exit(1);
  }

  else
  {
    //querystring exist
    $username = $_GET['user'];
    $password = $_GET['pass'];
  }

  $savedpassword =  mytestpassword;
  $saveduser = test1;


  //check pass and user string
  //if (strcmp($password,$savedpassword)==0 &&  strcmp($username,$saveduser)==0 )
  if ($_GET['app'] == "testroom")
  {
    echo "Password and Username OK!";
  }

  else
  {
    echo "password or username wrong! ";
    header('HTTP/1.0 404 Not Found'); //kein stream
  }


?>
