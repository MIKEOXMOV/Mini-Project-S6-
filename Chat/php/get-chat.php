<?php
  session_start();
  include_once "config.php";

  $outgoing_id = $_SESSION['unique_id'];
  $incoming_id = $_POST['incoming_id'];

  $sql = "SELECT * FROM messages 
          WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id}) 
          OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) 
          ORDER BY msg_id DESC";

  $query = mysqli_query($conn, $sql);
  $output = "";

  while($row = mysqli_fetch_assoc($query)){
    $user_sql = "SELECT * FROM users WHERE unique_id = {$row['outgoing_msg_id']}";
    $user_query = mysqli_query($conn, $user_sql);
    $user_row = mysqli_fetch_assoc($user_query);

    if($row['outgoing_msg_id'] === $outgoing_id){
      $output.= '<div class="chat outgoing">
                    <div class="details">
                      <p>'. $row['msg'].'</p>
                      <span>'. $user_row['fname'].' '. $user_row['lname'].'</span>
                    </div>
                  </div>';
    }else{
      $output.= '<div class="chat incoming">
                    <img src="php/images/'. $user_row['img'].'" alt="">
                    <div class="details">
                      <p>'. $row['msg'].'</p>
                      <span>'. $user_row['fname'].' '. $user_row['lname'].'</span>
                    </div>
                  </div>';
    }
  }

  echo $output;
?>