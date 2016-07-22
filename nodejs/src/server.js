var app = require("http").createServer(handler),
    io = require('socket.io').listen(app),
    fs = require("fs"),
    redis = require("redis"),
    co = require("./cookie.js"),
    clientSession = new redis.createClient(6379, 'redis', {no_ready_check: true}),
    querystring = require('querystring');

app.listen(3000);

//On client incomming, we send back index.html
function handler(req, res) {
}

clientSession.on('connect', function() {
    console.log('connected to redis');
});

var connect = require('connect');
io.sockets.on( 'connection', function( client ) {
    //Using php session to retrieve important data from user
    var username = null;
    var isLoggedIn = false;
    var cookieManager = new co.cookie(client.request.headers.cookie);

    clientSession.get("sessions/" + querystring.unescape(cookieManager.get("PHPSESSID")), function(error, result) {
        if(error) {
            console.log("error : " + error);
        }
        if(result != null) {
          var session_r = JSON.parse(result);
            username = session_r.username;
            console.log("GOT: " + session_r.username);
            isLoggedIn = true;
        } else {
            console.log("session does not exist");
        }
    });

	client.on( 'send message', function( data ) {
    if(isLoggedIn && username != null)
    {
  		console.log( 'Message received ' + username + ":" + data.message );
  		//client.broadcast.emit( 'message', { name: data.name, message: data.message } );
  		io.sockets.emit('new message', { username: username, message: data.message } );
    }
	});
});
