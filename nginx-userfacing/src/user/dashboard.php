<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php');
  if($SERVER_CFG['REDIS_ENABLED'] == true)
    include $SERVER_PATH['libs-php'].'/redis.php';
  session_start();
  require_once($SERVER_PATH['libs-php'].'/error_functions.php');
  require_once($SERVER_PATH['libs-php'].'/DatabaseManager.php');

  if(!isset($_SESSION['username'])) call404Error("User not signed in.");
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

        <div class="row-fluid">
          <div class="col-md-3">
              <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
                <ul class="nav bs-docs-sidenav">
                  <li class=""> <a href="#glyphicons">Dashboard</a></li>
                  <li class=""> <a href="#glyphicons">Settings</a></li>
                  <li class=""> <a href="#glyphicons">Analytics</a></li>
                 </ul>
               </nav>
          </div>

          <div class="col-md-9">
            <h2>Your streams</h2>
            <?php

              // Update database and connect
              $dm = new DatabaseManager;
              $conn = $dm->connect();
              $user_id = $dm->getUserIDByUsername($_SESSION['username']);

              // load all available streams
              $LiveUsers = $dm->getAllVidoeStreamsByID($user_id);
              foreach($LiveUsers as &$value)
              {
                echo("<a href=\"/watch.php?tag=".$value->tag."\">".$value->title." </a>");
                if($state == 0)
                  echo(" (Offline)");
                else
                  echo("- Online");
                echo("<br/>");
              }

            ?>
          </div>
        </div>



      </div>

    <?php include($SERVER_PATH['inserts-footer']); ?>
    <?php include($SERVER_PATH['inserts-footer-libs']); ?>
    <?php include($SERVER_PATH['inserts-google-analytics']); ?>
    </body>
</html>
