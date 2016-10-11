<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php');
  if($SERVER_CFG['REDIS_ENABLED'] == true)
    include $SERVER_PATH['libs-php'].'/redis.php';
  session_start();
?>
<?php
  require_once($SERVER_PATH['libs-php'].'/DatabaseManager.php');
  require_once($SERVER_PATH['libs-php'].'/error_functions.php');

  // Update database and connect
  $dm = new DatabaseManager;
  $conn = $dm->connect();

  $tag = $_GET['tag'];
  $stream = $dm->getVideoStreamByTag($tag);
  if($stream == NULL) call404Error("Stream does not exist.");
  $author = $dm->getVideoStreamOwner($stream['user_id']);
  if($author == NULL) call404Error("Stream does not exist.");

  $dm->disconnect();
 ?>


<!doctype html>
<html>
  <head>
      <title><?php  echo($stream['title']); ?> - live</title>
      <meta name="description" content="">
      <?php include($SERVER_PATH['inserts-header-libs']); ?>
  </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <?php
          if(isset($_SESSION['username']))
            include($SERVER_PATH['inserts-navbar-signedin']);
          else
            include($SERVER_PATH['inserts-navbar-notsigned']);
        ?>

        <div class="container">
          <!-- Add your site or application content here -->
          <a href="/index.php">Back</a>
          <br>
          <h3>Stream</h3>
          <p>Author = <?php echo($author->username); ?></p>
          <p>Title = <?php echo($stream['title']); ?></p>
          <p>Description = <?php echo($stream['description']); ?></p>

          <?php
            $STREAM_TARGET_VIDEO = $tag;
            $STREAM_TARGET_CHAT = $tag;
            $STREAM_PWD = $_GET['pwd'];
          ?>
          <?php include($SERVER_PATH['inserts-footer-libs']); ?>
          <?php include($SERVER_PATH['inserts-google-analytics']); ?>
          <div class="row-fluid">
            <div class="col-md-7">
              <?php include($SERVER_PATH['inserts-stream-video']); ?>
            </div>
            <div class="col-md-5">
              <?php include($SERVER_PATH['inserts-stream-chat']); ?>
            </div>
           </div> <!-- Closing row -->

           <!--
           <div id="stream_embed"></div>
           <script>
              (function() {
                  var d = document, s = d.createElement('script');
                  s.src = 'http://localhost:8000/libs/js/embed.js';  // IMPORTANT: Replace EXAMPLE with your forum shortname!

                  s.setAttribute('STREAM_TARGET_VIDEO', '<?php// echo($tag); ?>');
                  s.setAttribute('STREAM_TARGET_CHAT', '<?php //echo($tag); ?>');
                  (d.head || d.body).appendChild(s);
              })();
          </script>
          <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">streams powered by GoLive.</a></noscript>
        -->

          <?php include($SERVER_PATH['inserts-footer']); ?>
         </div> <!-- Closing container -->
    </body>
</html>
