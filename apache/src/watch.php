<?php require_once($_SERVER['DOCUMENT_ROOT'].'/cfg.php'); ?>
<?php
  require_once($SERVER_PATH['libs-php'].'/DatabaseManager.php');
  require_once($SERVER_PATH['libs-php'].'/error_functions.php');

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
          <div id="embed_player"></div>
           <script type='text/javascript'>
           var playerInstance = jwplayer("embed_player");
             playerInstance.setup({
             <?php echo("'file': 'rtmp://".$MEDIA_SERVER['HOST'].":".$MEDIA_SERVER['PORT']."/stream/".$author."',") ?>
             'primary': "flash",
             'image': "http://content.jwplatform.com/videos/nhYDGoyh-kNspJqnJ.mp4",
             'width':'640',
             'height':'360'
           });
           </script>
         </div>

         <?php include($SERVER_PATH['inserts-footer-libs']); ?>
         <?php include($SERVER_PATH['inserts-google-analytics']); ?>
    </body>
</html>
