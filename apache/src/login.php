<?php

define('EXPRESS_SECRET', 'sitesecretkey');

session_start();

session_regenerate_id();
$sess_id = session_id();
$hmac = str_replace("=", "", base64_encode(hash_hmac('sha256', $sess_id, EXPRESS_SECRET, true)));
// format it according to the express-session signed cookie format
//session_id("$sess_id.$hmac");

$_SESSION['username'] = "jacobTest1";
$_SESSION["sess_id"] = $sess_id;
$_SESSION["Hmac"] = $hmac;

?>
