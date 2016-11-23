var appRouter = function(app) {

   /*app.get("/on_publish", function(req, res) {
    	res.send("On publish.");
   });

   app.get("/on_play", function(req, res) {
    	res.send("On play.");
   });

   app.get("/edge_redirect", function(req, res) {
    //  res.send("test");
      //res.redirect('rtmp://138.68.131.239:1935/origin/'+req.query.name);
      console.log(req.url);
      res.redirect('rtmp://138.68.131.239:1935/origin/test');
   }); */

   app.get('/edge_redirect/:name', function(req , res){
      console.log(req);
      res.redirect('rtmp://138.68.131.239:1935/origin/'+req.params.name);
    });

  /*app.get('*', function(req , res){
      console.log(req + "/n/n/n/n/n");
     console.log(req);
     res.redirect('rtmp://138.68.131.239:1935/origin/test');
   });*/


}
module.exports = appRouter;
