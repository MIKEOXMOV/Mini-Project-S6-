<?php
session_start();

// Include database connection
include_once "../php/config.php";

if(isset($_GET['logout_id'])){
  $id = mysqli_real_escape_string($conn, $_GET['logout_id']);
  if(isset($_SESSION['unique_id'])){
    $status = "offline now";
    $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$id}");
    if($sql){
      session_unset();
      session_destroy();
      header("location: ../login.php");
    } else {
      echo "Error updating status: " . mysqli_error($conn);
    }
  } else {
    header("location: ../login.php");
  }
} else {
  header("location: ../users.php");
}
?>
