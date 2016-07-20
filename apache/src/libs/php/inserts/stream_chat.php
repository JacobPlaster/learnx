<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
<script>
   var socket = io.connect("http://<?php echo($SERVER_CFG['SOCKET_HOST'].':'.$SERVER_CFG['SOCKET_PORT']); ?>");
   var username;


   socket.on('new message',function(data) {
     addMessage(data.username, data.message);
   });
   function addMessage(username, message) {
       var text = document.createTextNode(username + ": "+ message),
           el = document.createElement('li'),
           messages = document.getElementById('stream_chat');
       el.appendChild(text);
       messages.appendChild(el);
   }
   function setUsername(newUsername)
   {
     socket.emit('add user', newUsername);
     username = newUsername;
   }


   $(document).ready(function() {
    setUsername("Test");
    $('#stream_chat_input').on('keypress', function (event) {
      // enter key pressed
      if(event.which === 13){
        var message = $("#stream_chat_input").val();
        if(message.length > 2)
        {
          socket.emit("send message", {username:username, message:message});
          addMessage(username, message);
          // clear
          $("#stream_chat_input").val("");
        }
      }
    });
  });
</script>

<div class="stream_chat">
    <div>Logged in as: <?php echo($_SESSION['username']) ?></div>
  <ul id='stream_chat' class="message_area">
  </ul>
  <div class="message_input">
    <input type="text" id="stream_chat_input">
  </div>
</div>
