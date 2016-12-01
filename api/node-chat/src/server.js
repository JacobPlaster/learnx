var app = require("http").createServer(handler),
    io = require('socket.io').listen(app),
    fs = require("fs"),
    redis = require("redis"),
    co = require("./cookie.js"),
    clientRedisSession = new redis.createClient(6379, 'redis', {no_ready_check: true}),
    querystring = require('querystring'),
    mysql = require("mysql");

app.listen(3000);

// First you need to create a connection to the db
var mysqlCon = mysql.createConnection({
  host: "db",
  user: "root",
  password: "root",
  database : 'learnx'
});
mysqlCon.connect(function(err){
  if(err){
    console.log('Error connecting to mysql Db');
    return;
  }
  console.log('Connection established');
});
// redis on connect
clientRedisSession.on('connect', function() {
    console.log('connected to redis');
});


//On client incomming
function handler(req, res) {
}

// socket io //
var connect = require('connect');
io.sockets.on( 'connection', function( client ) {
    var room = querystring.escape(client.handshake['query']['r_var']);
    var username = null;
    var isLoggedIn = false;

    var query = mysqlCon.query("SELECT 1 FROM stream_chat WHERE tag = '" + room + "' LIMIT 1", function(err, result, fields) {
          // room exists
          if (result.length  > 0) {
            client.join(room);
            console.log('user joined room #'+room);
            io.to(client).emit('info', { message: "Connected to #"+room+"." } );
            //Using php session to retrieve important data from user
            var cookieManager = new co.cookie(client.request.headers.cookie);
            clientRedisSession.get("sessions/" + querystring.unescape(cookieManager.get("PHPSESSID")), function(error, result) {
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
                    io.to(client).emit('error', { message: "Please log in to send messages." } );
                }
            });
            // chat room does not exist
          } else {
            io.to(client).emit('error', { message: "Chat room does not exist." } );
            client.error("Room does not exist.");
            client.disconnect();
          }
    });

	client.on( 'send message', function( data ) {
    if(isLoggedIn && username != null)
    {
      data.message =  querystring.escape(data.message);
  		console.log( 'Message received ' + username + ":" + data.message );
  		//client.broadcast.emit( 'message', { name: data.name, message: data.message } );
  		io.to(room).emit('new message', { username: username, message: data.message } );
    } else {
      io.to(client).emit('error', { message: "Please log in to send messages." } );
    }
	});

  client.on('disconnect', function() {
   client.leave(room)
   console.log('user disconnected');
 });
});
