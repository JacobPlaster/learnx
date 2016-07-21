var express = require('express'),
    app = express()
  , cookieParser = require('cookie-parser')
  , http = require('http')
  , server = http.createServer(app)
  , io = require('socket.io').listen(server)
  , redis = require('redis')
  , session = require('express-session')
  , redisStore = require('connect-redis')(session)
  , client = redis.createClient(6379, 'redis', {no_ready_check: true})
  , co = require("./cookie.js");

var PORT = 3000;

app.use(cookieParser());
app.use(session({
    secret: 'sitesecretkey',
    // create new redis store.
    store: new redisStore({ host: 'redis', port: 6379, client: client,  prefix: 'PHPREDIS_SESSION:'}),
    name: 'PHPSESSID',
    saveUninitialized: false,
    resave: false
}));

client.on("error", function (err) {
    console.log("Redis Client Error: " + err);
});

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
