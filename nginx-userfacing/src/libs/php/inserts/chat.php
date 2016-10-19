<html>
<head>
  <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>

  <script>
     var socket = io.connect( 'http://localhost:3000' );

     socket.on('time', function(data) {
         addMessage(data.time);
     });

     function addMessage(message) {
         var text = document.createTextNode(message),
             el = document.createElement('li'),
             messages = document.getElementById('messages');

         el.appendChild(text);
         messages.appendChild(el);
     }
 </script>


<ul id='messages'></ul>

</head>
<body>
</body>
</html>
