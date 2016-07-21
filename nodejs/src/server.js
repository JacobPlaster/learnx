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
    //Using php session to retrieve important data from user
    var cookieManager = new co.cookie(req.headers.cookie);

    //Note : to specify host and port : new redis.createClient(HOST, PORT, options)
    //For default version, you don't need to specify host and port, it will use default one
    console.log('cookieManager.get("PHPSESSID") = ' + querystring.unescape(cookieManager.get("PHPSESSID")));
    clientSession.get("sessions/" + querystring.unescape(cookieManager.get("PHPSESSID")), function(error, result) {
        console.log("error : " + result);
        if(error) {
            console.log("error : " + error);
        }
        if(result != null) {
            console.log("result exist");
            console.log(result.toString());
        } else {
            console.log("session does not exist");
        }
    });
}

clientSession.on('connect', function() {
    console.log('connected to redis');
});

io.sockets.on( 'connection', function( client ) {
	console.log( "New client !" );

	client.on( 'send message', function( data ) {
		console.log( 'Message received ' + data.username + ":" + data.message );

		//client.broadcast.emit( 'message', { name: data.name, message: data.message } );
		io.sockets.emit('new message', { username: data.username, message: data.message } );
	});
});
