<?php
  session_start();
  include_once "config.php";

  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>

<html>
<head>
  <title>Chatroom</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="chat-box">
      <div class="chat-header">
        <h4>Chatroom</h4>
      </div>
      <div class="chat-body" id="chat-body">
        <!-- chat messages will be displayed here -->
      </div>
      <form action="#" id="chat-form">
        <input type="text" id="message" placeholder="Type a message...">
        <button type="submit">Send</button>
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    $(document).ready(function(){
      $.ajaxSetup({
        cache: false
      });

      loadChat();

      $('#chat-form').submit(function(event){
        event.preventDefault();
        var message = $('#message').val();
        $.post('insert-chat.php', {incoming_id: '<?php echo $_SESSION['incoming_id'];?>', message: message}, function(data){
          $('#message').val('');
          loadChat();
        });
      });

      function loadChat(){
        $.post('get-chat.php', {incoming_id: '<?php echo $_SESSION['incoming_id'];?>'}, function(data){
          $('#chat-body').html(data);
        });
      }

      setInterval(function(){
        loadChat();
      }, 1000);
    });
  </script>
</body>
</html>