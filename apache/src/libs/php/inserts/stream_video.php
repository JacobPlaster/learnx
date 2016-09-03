<script src="http://content.jwplatform.com/libraries/DH7EyvON.js"></script>
<div id="embed_player"></div>
 <script type='text/javascript'>
 var playerInstance = jwplayer("embed_player");
   playerInstance.setup({
   <?php
      if(isset($STREAM_PWD) && $STREAM_PWD != NULL)
      {
        echo("'file': 'rtmp://".$MEDIA_SERVER['HOST'].":".$MEDIA_SERVER['PORT']."/stream?pwd=".$STREAM_PWD."/".$STREAM_TARGET_VIDEO."',");
      } else {
        echo("'file': 'rtmp://".$MEDIA_SERVER['HOST'].":".$MEDIA_SERVER['PORT']."/stream/".$STREAM_TARGET_VIDEO."',");
      }
    ?>
   'primary': "flash",
   'image': "http://content.jwplatform.com/videos/nhYDGoyh-kNspJqnJ.mp4",
   'width':'640',
   'height':'360'
 });
 </script>
