var this_js_script = $('script[src*=embed]'); // or better regexp to get the file name..

var VIDEO_STREAM_TAG = this_js_script.attr('STREAM_TARGET_VIDEO');
var isVideoEmbed = false;
var CHAT_STREAM_TAG = this_js_script.attr('STREAM_TARGET_CHAT');
var isChatEmbed = false;

if (VIDEO_STREAM_TAG != "undefined" ) {
   isVideoEmbed = true;
}
if (CHAT_STREAM_TAG != "undefined" ) {
   isChatEmbed = true;
}

var embed_div = document.getElementById("stream_embed");


// **** EMBED VIDEO STREAM ******* //


// **** EMVED CHAT STREAM ******** //
