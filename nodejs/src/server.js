var express = require('express'),
    app = express()
  , http = require('http')
  , server = http.createServer(app)
  , io = require('socket.io').listen(server);

var PORT = 3000;

io.sockets.on( 'connection', function( client ) {
	console.log( "New client !" );

	client.on( 'message', function( data ) {
		console.log( 'Message received ' + data.name + ":" + data.message );

		//client.broadcast.emit( 'message', { name: data.name, message: data.message } );
		io.sockets.emit( 'message', { name: data.name, message: data.message } );
	});
});

// Send current time to all connected clients
function sendTime() {
    io.emit('time', { time: new Date().toJSON() });
}

// Send current time every 10 secs
setInterval(sendTime, 10000);

// listen for new web clients:
server.listen(PORT);
