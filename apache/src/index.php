<?php require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php'); ?>
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
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">
          <!-- Add your site or application content here -->
          <h1>Streams!</h1>

          <?php
            require_once($SERVER_PATH['libs-php'].'/DatabaseManager.php');

            // Update database and connect
            $dm = new DatabaseManager;
            $conn = $dm->connect();

            // load all available streams
            $LiveUsers = $dm->getAllLiveStreams();
            foreach($LiveUsers as &$value)
            {
              echo("<a href=\"/watch.php?author=".$value['username']."\">".$value['username']."</a> - ".$value['title']);
              echo("<br/>");
            }

            $dm->disconnect();

           ?>
         </div>

    <?php include($SERVER_PATH['inserts-footer-libs']); ?>
    <?php include($SERVER_PATH['inserts-google-analytics']); ?>
    </body>
</html>
