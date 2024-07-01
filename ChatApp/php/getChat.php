<?php
session_start();
if(isset($_SESSION['unique_id'])){
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = isset($_POST['incoming_id']) ? $_POST['incoming_id'] : null;
    $group_id = isset($_POST['group_id']) ? $_POST['group_id'] : null;
    $output = "";

    if($incoming_id){
        $sql = "SELECT * FROM messages WHERE (incoming_msg_id = {$incoming_id} AND outgoing_msg_id = {$outgoing_id})
                OR (incoming_msg_id = {$outgoing_id} AND outgoing_msg_id = {$incoming_id}) ORDER BY msg_id";
    } elseif($group_id){
        $sql = "SELECT * FROM messages WHERE group_id = {$group_id} ORDER BY msg_id";
    }

    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            if($row['outgoing_msg_id'] === $outgoing_id){
                $output .= '<div class="chat outgoing">
                              <div class="details">
                                <p>'. $row['msg'] .'</p>
                              </div>
                            </div>';
            } else {
                $output .= '<div class="chat incoming">
                              <img src="php/images/'.$row['img'].'" alt="">
                              <div class="details">
                                <p>'. $row['msg'] .'</p>
                              </div>
                            </div>';
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send a message, they will appear here.</div>';
    }
    echo $output;
}
?>
