<?php

define('EXPRESS_SECRET', 'sitesecretkey');

session_start();

$_SESSION['username'] = "jacobTest1";
$_SESSION["sess_id"] = $sess_id;
$_SESSION["Hmac"] = $hmac;

?>
