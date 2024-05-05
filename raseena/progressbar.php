<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the POST request
$group_name = $_POST["group_name"];
$activity_name = $_POST["activity_name"];
$completed = $_POST["completed"];

// Update progress in the database
$sql = "INSERT INTO group_progress (group_name, activity_name, activity_completed) VALUES ('$group_name', '$activity_name', $completed)";

if ($conn->query($sql) === TRUE) {
    echo "Progress updated successfully";
} else {
    echo "Error updating progress: " . $conn->error;
}

$conn->close();
?>
