var appRouter = function(app) {



    /*
    // On play is get
    app.get("/on_play", function(req, res) {
      var streamName = req.query.name;
      // check if allowed to play
      // check if stream exists
      // find best to redirect to
      res.redirect('rtmp://138.68.131.239:1935/origin_rtmp/'+streamName);
    }); */

    // on publish is post
    app.post('/internal/publish_authentication', function(req, res) {
      //var streamName = req.body.name;
      var streamName = "test";
      res.send('Authentication for ' + streamName + " is successfull.");
      console.log("Authentication success: " + streamName);
      console.log(req.body);
     });

     // on publish is post
     app.get('/internal/publish_authentication', function(req, res) {
       //var streamName = req.body.name;
       var streamName = "test";
       res.send('Authentication for ' + streamName + " is successfull.");
       console.log("Authentication success: " + streamName);
      });
}
module.exports = appRouter;
