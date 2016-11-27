var appRouter = function(app) {

  app.get("/on_publish", function(req, res) {
    	res.send("On publish.");
   });

   app.get("/on_play", function(req, res) {
    	res.send("On play.");
   });

   app.get("/origin_to_edge", function(req, res) {
     var streamName = req.query.name;
     // check if allowed to play
     // check if stream exists
     // find best to redirect to
     console.log(req);
     res.redirect('rtmp://138.68.135.81:1935/edge/'+streamName);
   });

   app.post('/test-page', function(req, res) {
    console.log(req);
    var name = req.body.name;
    res.redirect('rtmp://138.68.135.81:1935/edge/'+streamName);
});

   /*
   app.get("/", function(req, res) {
     console.log(req);

     // check if allowed to play
     // check if stream exists
     // find best to redirect to
     res.redirect('rtmp://138.68.135.81:1935/edge/test');
   }); */
}
module.exports = appRouter;
