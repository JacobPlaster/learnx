var express = require("express");
var bodyParser = require("body-parser");
var app = express();
var routes = require("./routes/routes.js")(app);

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

var internalRoutes = require("./routes/InternalRoutes.js")(app);
var apiRoutes = require("./routes/ApiRoutes.js")(app);

var server = app.listen(3000, function () {
    console.log("Listening on port %s...", server.address().port);
});
