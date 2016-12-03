var request = require('request');

var appRouter = function(app) {


    // CHECK USER HAS PERMISSION FOR THESE
    // look into session tokens


     // on publish is post
     app.get('/api/drop_stream', function(req, res) {
       var streamName = req.query.name;

       var streamApp = "origin";
       var streamHost = "138.68.131.239";
       var streamHostPort = "80";

       request('http://'+streamHost+':'+streamHostPort+'/control/drop/publisher?app='+streamApp+'&name='+streamName, function (error, response, body) {
          if (!error && response.statusCode == 200) {
            res.send('OK');
            console.log("Killing stream: " + streamName);
          } else
          {
            res.send('ERROR');
            console.log("Failed to kill stream: " + streamName);
          }
        });
      });


      // on publish is post
      app.get('/api/rename_stream', function(req, res) {
        var streamName = req.query.name;
        var streamNewName = req.query.newname;

        var streamApp = "origin";
        var streamHost = "138.68.131.239";
        var streamHostPort = "80";

        request('http://'+streamHost+':'+streamHostPort+'/control/redirect/publisher?app='+streamApp+'&name='+streamName+'&newname='+streamNewName,
          function (error, response, body) {
           if (!error && response.statusCode == 200) {
             res.send('OK');
             console.log("Renamig stream: " + streamName + " to " + streamNewName);
           } else {
             res.send('ERROR');
             console.log("Failed to rename stream: " + streamName) + ' to ' + streamNewName;
           }
         });
       });
}
module.exports = appRouter;
