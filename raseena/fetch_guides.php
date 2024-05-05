<?php
include 'db_connect.php';

$sql = "SELECT * FROM guide";
$result = $conn->query($sql);

$guides = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $guides[] = $row;
    }
}

echo json_encode($guides);

$conn->close();
?>
