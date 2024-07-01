<?php
session_start();
if(isset($_SESSION['unique_id'])){
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $incoming_id = isset($_POST['incoming_id']) ? $_POST['incoming_id'] : null;
    $group_id = isset($_POST['group_id']) ? $_POST['group_id'] : null;

    if(!empty($message)){
        if($incoming_id){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        } elseif($group_id){
            $sql = mysqli_query($conn, "INSERT INTO messages (group_id, outgoing_msg_id, msg) VALUES ({$group_id}, {$outgoing_id}, '{$message}')") or die();
        }
    }
}
?>
