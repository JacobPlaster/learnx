<!--<script src="http://content.jwplatform.com/libraries/DH7EyvON.js"></script>
<div id="embed_player"></div>
 <script type='text/javascript'>
 var playerInstance = jwplayer("embed_player");
   playerInstance.setup({
   <?php
      if(isset($STREAM_PWD) && $STREAM_PWD != NULL)
      {
        //echo("'file': 'http://".$MEDIA_SERVER['HOST'].":".$MEDIA_SERVER['PORT']."/stream?pwd=".$STREAM_PWD."/".$STREAM_TARGET_VIDEO."',");
      } else {
        echo("'file': 'http://".$MEDIA_SERVER['HOST'].":".$MEDIA_SERVER['PORT']."/hls/".$STREAM_TARGET_VIDEO.".m3u8',");
      }
    ?>
   'primary': "flash",
   'image': "http://content.jwplatform.com/videos/nhYDGoyh-kNspJqnJ.mp4",
   'width':'640',
   'height':'360'
 });
 </script> -->

<script src="<?php echo($SERVER_PATH['libs-javascript']) ?>/flowplayer/flowplayer.min.js"></script>
<!-- Flowplayer hlsjs engine -->
<script src="//releases.flowplayer.org/hlsjs/flowplayer.hlsjs.min.js"></script>


<div data-live="true"
     data-ratio="0.5625"
     class="flowplayer fixed-controls">

   <video data-title="Live stream">
<source type="application/x-mpegurl"
        src="http://localhost:8081/hls/cssfg.m3u8">
   </video>

</div>
