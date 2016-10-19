<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php');
//include $SERVER_PATH['libs-php'].'/redis.php';
session_start();
session_unset();
session_destroy();
header('Location: /index.php');
?>
