var appRouter = function(app) {
  /*
   // on pubish is post request
   app.post('/origin_to_edge', function(req, res) {
      console.log(req);
      //var streamName = req.body.name;
      var streamName = "test";
      res.redirect('rtmp://138.68.135.81:1935/edge/'+streamName);
    });

    app.get("/on_playt", function(req, res) {
      var streamName = req.query.name;
      // check if allowed to play
      // check if stream exists
      // find best to redirect to
      res.redirect('rtmp://138.68.131.239:1935/origin_rtmp/'+streamName);
    }); */

    app.get("/internal/publish_authentication", function(req, res) {
      var streamName = req.query.name;
      res.send('Authentication for ' + streamName + " is successfull.");
      console.log("Authentication success: " + streamName);
      console.log(req.query);

    });
}
module.exports = appRouter;
