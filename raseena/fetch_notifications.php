<?php

session_start();
if (isset($_SESSION['name'])) {
    // Session variable exists, do something
    $userId = $_SESSION['guideId'];
} else {
    // Session variable doesn't exist or user is not logged in
}
// Connect to MySQL database
$conn = new mysqli('localhost', 'root', '', 'project1');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch notifications for the logged-in user
$userId = $_SESSION['guideId']; // Assuming you have a session variable for user ID
$sql = "SELECT id, student_id FROM requests WHERE guide_id = $userId AND status = 'pending'";
$result = $conn->query($sql);

$notifications = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = [
            'id' => $row['id'],
            'requester' => $row['student_id']
        ];
    }
}

$conn->close();

// Return notifications as JSON
header('Content-Type: application/json');
echo json_encode($notifications);
