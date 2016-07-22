<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php');
include $SERVER_PATH['libs-php'].'/redis.php';

session_start();

$_SESSION['username'] =  $_GET['u'];

echo '<pre>';
var_dump($_COOKIE);
echo '</pre>';

?>
