var appRouter = function(app) {

  /*app.get("/on_publish", function(req, res) {
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
   }); */

   // on pubish is post request
   app.post('/origin_to_edge', function(req, res) {
      console.log(req);
      //var streamName = req.body.name;
      var streamName = "test";
      res.redirect('rtmp://138.68.135.81:1935/edge/'+streamName);
    });

    app.get("/edge_rtmp_redirect", function(req, res) {
      var streamName = req.query.name;
      // check if allowed to play
      // check if stream exists
      // find best to redirect to
      res.redirect('rtmp://138.68.131.239:1935/origin_rtmp/'+streamName);
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
