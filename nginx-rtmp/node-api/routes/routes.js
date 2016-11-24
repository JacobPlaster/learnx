var appRouter = function(app) {

   app.get("/on_publish", function(req, res) {
    	res.send("On publish.");
   });

   app.get("/on_play", function(req, res) {
    	res.send("On play.");
   });

   app.get("/rtmp_redirect", function(req, res) {
     var streamName = req.query.name;
     // check if allowed to play
     // check if stream exists
     // find best to redirect to
     res.redirect('rtmp://138.68.131.239:1935/origin/'+streamName);
   });

   app.get("/hls_redirect", function(req, res) {
     var streamName = req.query.name;
     // check if allowed to play
     // check if stream exists
     // find best to redirect to
     console.log(req);
     res.redirect('http://138.68.131.239/hls/'+streamName+'.m3u8');
   });
}
module.exports = appRouter;
