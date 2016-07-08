'use strict';

// Constraints
var PORT = 3000;

var io = require('socket.io')();
io.on('connection', function(socket){});
io.listen(PORT);

console.log('Running on localhost:' + PORT);
