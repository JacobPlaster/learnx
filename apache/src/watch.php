<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/php/DatabaseManager.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/php/error_functions.php');

  // Update database and connect
  $dm = new DatabaseManager;
  $conn = $dm->connect();

  $author = $_GET['author'];
  $author_id = $dm->getUserIDByUsername($author);
  if($author_id == NULL) call404Error("Stream does not exist.");
  $stream = $dm->getStreamByID($author_id);
  if($stream == NULL) call404Error("Stream does not exist.");

  $dm->disconnect();
 ?>


<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>

        <script src="js/jwplayer/jwplayer.js"></script>
        <script>jwplayer.key="RYbIb4Mn7dHgygUN/h4k+pBmfKz3UGz0E+Lj6w==";</script>
        <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>

        <script>
           var socket = io.connect( 'http://localhost:3000' );

           socket.on('time', function(data) {
               addMessage(data.time);
           });

           function addMessage(message) {
               var text = document.createTextNode(message),
                   el = document.createElement('li'),
                   messages = document.getElementById('messages');

               el.appendChild(text);
               messages.appendChild(el);
           }
       </script>

    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <a href="/index.php">Back</a>
        <br>
        <h3>Stream</h3>
        <p>Author = <?php echo($author); ?></p>
        <p>Title = <?php echo($stream['title']); ?></p>
        <p>Description = <?php echo($stream['description']); ?></p>
        <div id="embed_player"></div>
         <script type='text/javascript'>
         var playerInstance = jwplayer("embed_player");
           playerInstance.setup({
           <?php echo("'file': '".$dm->getRed5ServerUrl($author)."',") ?>
           'primary': "flash",
           'image': "http://content.jwplatform.com/videos/nhYDGoyh-kNspJqnJ.mp4",
           'width':'640',
           'height':'360'
         });
         </script>

         <ul id='messages'></ul>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your sitss ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
