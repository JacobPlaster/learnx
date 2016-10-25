<!-- Flowplayer library -->
<script src="//releases.flowplayer.org/6.0.5/flowplayer.min.js"></script>
<!-- Flowplayer hlsjs engine -->
<script src="//releases.flowplayer.org/hlsjs/flowplayer.hlsjs.min.js"></script>
<div id="embed_player"></div>

<div data-live="true" data-ratio="0.5625" class="flowplayer fixed-controls">
   <video data-title="Live stream">
    <?php
      echo('<source type="application/x-mpegurl" src="http://');
      if(isset($STREAM_PWD) && $STREAM_PWD != NULL)
      {
        echo($MEDIA_SERVER['HOST'].":".$MEDIA_SERVER['PORT']."/hls/".$STREAM_TARGET_VIDEO.".m3u8?pwd=".$STREAM_PWD);
      } else {
        echo($MEDIA_SERVER['HOST'].":".$MEDIA_SERVER['PORT']."/hls/".$STREAM_TARGET_VIDEO.".m3u8");
      }
      echo('">');
    ?>
   </video>
</div>
