<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php');
  if($SERVER_CFG['REDIS_ENABLED'] == true)
    include $SERVER_PATH['libs-php'].'/redis.php';
  session_start();
?>
<!doctype html>
<html>
    <head>
        <title></title>
        <meta name="description" content="">
        <?php include($SERVER_PATH['inserts-header-libs']); ?>
    </head>
    <body>
    <?php
      if(isset($_SESSION['username']))
        include($SERVER_PATH['inserts-navbar-signedin']);
      else
        include($SERVER_PATH['inserts-navbar-notsigned']);
    ?>


    <?php include($SERVER_PATH['inserts-footer']); ?>
    <?php include($SERVER_PATH['inserts-footer-libs']); ?>
    <?php include($SERVER_PATH['inserts-google-analytics']); ?>
    </body>
</html>
