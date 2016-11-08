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

<!--
<script src="<?php echo($SERVER_PATH['libs-javascript']) ?>/flowplayer/flowplayer.min.js"></script>
<script src="//releases.flowplayer.org/hlsjs/flowplayer.hlsjs.min.js"></script>


<div data-live="true"
     data-ratio="0.5625"
     class="flowplayer fixed-controls">

   <video data-title="Live stream">
<source type="application/x-mpegurl"
        src="http://localhost:8081/hls/cssfg.m3u8">
   </video>

</div>
-->

<link href="http://vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">
  <script src="http://vjs.zencdn.net/4.12/video.js"></script>
 <script src="https://github.com/videojs/videojs-contrib-media-sources/releases/download/v0.1.0/videojs-media-sources.js"></script>
  <script src="https://github.com/videojs/videojs-contrib-hls/releases/download/v0.11.2/videojs.hls.min.js"></script>


  <video id="my_video_1" class="video-js vjs-default-skin" controls preload="auto" width="640" height="268"
    data-setup='{}'>
      <source src="<?php echo("http://".$MEDIA_SERVER['HOST'].":".$MEDIA_SERVER['PORT']."/hls/test.m3u8") ?>" type='application/x-mpegURL'>
    </video>


<!--

<script src="http://cdn.dashjs.org/latest/dash.all.min.js"></script>
<body>
   <div>
       <?php
         echo('<video style="width: 640px; height: 360px;" data-dashjs-player autoplay src="http://'.$MEDIA_SERVER['HOST'].":".$MEDIA_SERVER['PORT'].'/dash/test.mpd" controls></video>')
      ?>
   </div>
</body>

-->
