<?php
  session_start();
  include_once "config.php";

  $outgoing_id = $_SESSION['unique_id'];
  $incoming_id = $_POST['incoming_id'];
  $message = $_POST['message'];

  if(!empty($message)){
    $sql = mysqli_query($conn, "INSERT INTO messages (outgoing_msg_id, incoming_msg_id, msg) 
                                VALUES ({$outgoing_id}, {$incoming_id}, '{$message}')") or die();
  }
?>