<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php');
  if($SERVER_CFG['REDIS_ENABLED'] == true)
    include $SERVER_PATH['libs-php'].'/redis.php';
  session_start();
  require_once($SERVER_PATH['libs-php'].'/error_functions.php');
  require_once($SERVER_PATH['libs-php'].'/DatabaseManager.php');

  if(!isset($_SESSION['username'])) echo("Please <a href='/login.php' target='_blank'>log in</a> or <a href='/login.php?r=true' target='_blank'>create account</a>.");
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
        if(isset($_GET['pid']))
        {
          $product = $dm->getProductByID($_GET['pid']);
        } else {
          $product = $dm->getProductByTitle($_GET['package']);
        }
        echo("<br>Cost: ".$product['price_gbp']);
        $dm->disconnect();


        if (isset($_POST['card_number'])) {
          echo("payment successful, card number: " + $_POST['card_number']);
        }

        include($SERVER_PATH['inserts-payment-form']);
       ?>

    <?php include($SERVER_PATH['inserts-footer']); ?>
    <?php include($SERVER_PATH['inserts-footer-libs']); ?>
    <?php include($SERVER_PATH['inserts-google-analytics']); ?>
    </body>
</html>
