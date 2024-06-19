<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php";?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <div class="content">
          <h2>Chatroom</h2>
        </div>
      </header>
      <div class="chat-box">
        <!-- Display all registered users here -->
        <?php 
          $sql = mysqli_query($conn, "SELECT * FROM users");
          while($row = mysqli_fetch_assoc($sql)){
            echo '<div class="chat">';
            echo '<div class="chat-image">';
            echo '<img src="php/images/'.$row['img'].'" alt="">';
            echo '</div>';
            echo '<div class="chat-details">';
            echo '<span>'. $row['fname'].' '. $row['lname'].'</span>';
            echo '</div>';
            echo '</div>';
          }
       ?>
      </div>
      <form action="#" class="typing-area">
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>