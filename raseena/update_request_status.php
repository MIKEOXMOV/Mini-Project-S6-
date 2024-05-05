<?php

error_log(print_r($_POST, true));
// Connect to MySQL database
$conn = new mysqli('localhost', 'root', '', 'project1');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get request ID and status from POST data
$requestId = $_POST['requestId'];
$status = $_POST['status'];
echo "requestId : ". $requestId;
echo "status : ".$status;
// Update request status in the database
$sql = "UPDATE requests SET status = '$status' WHERE id = $requestId";
if ($conn->query($sql) === TRUE) {
    // Request status updated successfully
    echo json_encode(['success' => true]);
} else {
    // Error updating request status
    echo json_encode(['success' => false]);
}

$conn->close();
