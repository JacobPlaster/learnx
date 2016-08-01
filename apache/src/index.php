<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php');
  include $SERVER_PATH['libs-php'].'/redis.php';
  session_start();
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
          <!-- Add your site or application content here -->
          <a href="/streams.php">Live streams</a>
        </div>

    <?php include($SERVER_PATH['inserts-footer-libs']); ?>
    <?php include($SERVER_PATH['inserts-google-analytics']); ?>
    </body>
</html>
