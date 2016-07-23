<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
<script>

    /* SOCKET IO */
   var socket = io.connect("http://<?php echo($SERVER_CFG['SOCKET_HOST'].':'.$SERVER_CFG['SOCKET_PORT']); ?>",
    { query: '<?php echo("r_var=".$author) ?>' });
   socket.on('new message',function(data) {
     addMessage(data.username, data.message);
   });
   socket.on('error',function(data) {
     addEreror(data.message);
   });



   /* HTML Accessors */
   function addMessage(username, message) {
       var text = document.createTextNode(username + ": "+ message),
           el = document.createElement('li');
       el.appendChild(text);
       appendToChat(el);
   }
   function addError(message) {
       var text = document.createTextNode("Error: "+ message),
           el = document.createElement('li');
       el.appendChild(text);
       el.className = "chatError";
       appendToChat(el);
   }
   function addInfo(message) {
       var text = document.createTextNode(message),
           el = document.createElement('li');
       el.appendChild(text);
       el.className = "chatInfo";
       appendToChat(el);
   }
   function appendToChat(element)
   {
     // check if stream is scrolled to bottom
     var box= document.getElementById("stream_chat");
     var isScrolledToBottom = box.scrollHeight - box.clientHeight <= box.scrollTop + 1;
     box.appendChild(element);
     // if so then set scroll to bottom
     if(isScrolledToBottom)
      box.scrollTop = box.scrollHeight - box.clientHeight;
   }



   /* Document ready */
   $(document).ready(function() {
    $('#stream_chat_input').on('keypress', function (event) {
      // enter key pressed
      if(event.which === 13){
        var message = $("#stream_chat_input").val();
        socket.emit("send message", {message:message});
        addMessage("username", message);
        // clear
        $("#stream_chat_input").val("");
      }
    });
  });
</script>

<div class="stream_chat">
  <div class="header">
    <?php
      if(isset($_SESSION['username']))
      {
        echo("Logged in as: <span class='highlight_1'>".$_SESSION['username']."</span>");
      } else {
        echo("Please <a href='/login.php'>log in</a> or <a href='/login.php'>create account</a>.");
      }
    ?>
  </div>
  <div class="message_area_container">
    <ul id='stream_chat' class="message_area scrollbar">
    </ul>
  </div>
  <div class="footer">
    <input type="text" id="stream_chat_input">
  </div>
</div>
