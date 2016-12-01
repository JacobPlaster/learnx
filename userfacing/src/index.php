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

        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">


        </div>

    <?php include($SERVER_PATH['inserts-footer']); ?>
    <?php include($SERVER_PATH['inserts-footer-libs']); ?>
    <?php include($SERVER_PATH['inserts-google-analytics']); ?>
    </body>
</html>
