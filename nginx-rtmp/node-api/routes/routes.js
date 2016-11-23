var appRouter = function(app) {

   app.get("/on_publish", function(req, res) {
    	res.send("On publish.");
   });

   app.get("/on_play", function(req, res) {
    	res.send("On play.");
   });

   app.get("/edge_redirect", function(req, res) {
     var streamName = req.query.name;
     res.redirect('rtmp://138.68.131.239:1935/origin/'+streamName);
   });
}
module.exports = appRouter;
