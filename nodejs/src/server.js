var express = require('express'),
    app = express()
  , http = require('http')
  , server = http.createServer(app)
  , io = require('socket.io').listen(server);

var PORT = 3000;

io.sockets.on( 'connection', function( client ) {
	console.log( "New client !" );

	client.on( 'send message', function( data ) {
		console.log( 'Message received ' + data.username + ":" + data.message );

		//client.broadcast.emit( 'message', { name: data.name, message: data.message } );
		io.sockets.emit('new message', { username: data.username, message: data.message } );
	});
});

// listen for new web clients:
server.listen(PORT);
