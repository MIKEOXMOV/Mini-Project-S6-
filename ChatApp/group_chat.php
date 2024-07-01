<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          $group_id = mysqli_real_escape_string($conn, $_GET['group_id']);
          if($group_id){
            $sql = mysqli_query($conn, "SELECT * FROM groups WHERE group_id = {$group_id}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }else{
              header("location: groups.php");
            }
          }else{
            header("location: groups.php");
          }
        ?>
        <a href="groups.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['group_icon']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['group_name'] ?></span>
          <p><?php echo $row['group_description']; ?></p>
        </div>
      </header>
      <div class="chat-box">
        <!-- Chat messages will be loaded here from js/chat.js -->
      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" hidden>
        <input type="text" class="group_id" name="group_id" value="<?php echo $group_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>
