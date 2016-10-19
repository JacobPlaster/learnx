<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php');
  if($SERVER_CFG['REDIS_ENABLED'] == true)
    include $SERVER_PATH['libs-php'].'/redis.php';
  session_start();
  require_once($SERVER_PATH['libs-php'].'/error_functions.php');
  require_once($SERVER_PATH['libs-php'].'/DatabaseManager.php');

  if(!isset($_SESSION['username'])) call404Error("User not signed in.");
  // get product via id
?>
<!doctype html>
<html>
    <head>
        <title>Payment</title>
        <meta name="description" content="">
        <?php include($SERVER_PATH['inserts-header-libs']); ?>
    </head>
    <body>


      <?php

        require_once($SERVER_PATH['libs-php'].'/DatabaseManager.php');

        // Update database and connect
        $dm = new DatabaseManager;
        $conn = $dm->connect();

        // load all available streams
        $product = $dm->getProductByTitle($_GET['package']);
        echo("Cost: ".$product['price_gbp']);
        $dm->disconnect();

       ?>

       <a href="#">Buy now</a>

    <?php include($SERVER_PATH['inserts-footer']); ?>
    <?php include($SERVER_PATH['inserts-footer-libs']); ?>
    <?php include($SERVER_PATH['inserts-google-analytics']); ?>
    </body>
</html>
