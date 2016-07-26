<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php');
  include $SERVER_PATH['libs-php'].'/redis.php';
  session_start();
?>
<?php
  require_once($SERVER_PATH['libs-php'].'/DatabaseManager.php');
  require_once($SERVER_PATH['libs-php'].'/error_functions.php');
  session_start();

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
      <title><?php echo($author); ?> - live</title>
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
          <a href="/index.php">Back</a>
          <br>
          <h3>Stream</h3>
          <p>Author = <?php echo($author); ?></p>
          <p>Title = <?php echo($stream['title']); ?></p>
          <p>Description = <?php echo($stream['description']); ?></p>

          <?php
            $STREAM_TARGET_VIDEO = $author;
            $STREAM_TARGET_CHAT = $author;
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

         </div> <!-- Closing container -->
    </body>
</html>
