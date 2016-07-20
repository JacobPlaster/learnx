var express = require('express'),
    app = express()
  , http = require('http')
  , server = http.createServer(app)
  , io = require('socket.io').listen(server)
  , redis = require('redis')
  , session = require('express-session')
  , redisStore = require('connect-redis')(session)
  , client = redis.createClient();

var PORT = 3000;

app.use(session({
    secret: 'ssshhhhh',
    // create new redis store.
    store: new redisStore({ host: 'localhost', port: 6379, client: client,  prefix: 'session:php:'}),
    saveUninitialized: false,
    resave: false
}));

// test
app.use(function(req, res, next) {
    req.session.test = 'Hello from node.js!';
    req.session.save();
    console.log("Session: " + JSON.stringify(req.session, null, '  '));
});

client.on('connect', function() {
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

// listen for new web clients:
server.listen(PORT);
