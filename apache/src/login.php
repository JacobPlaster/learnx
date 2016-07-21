<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php');
include $SERVER_PATH['libs-php'].'/redis.php';

session_start();

$_SESSION['username'] = "jacobTest1";
$_SESSION["sess_id"] = $sess_id;
$_SESSION["Hmac"] = $hmac;

echo '<pre>';
var_dump($_COOKIE);
echo '</pre>';

echo '$_SESSION["nodejs"] = '.$_SESSION[selfId].'<br>';
$_SESSION[selfId] = 2;
echo '$_SESSION["nodejs"] = '.$_SESSION[selfId].'<br>';

?>
