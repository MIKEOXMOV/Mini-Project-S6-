<?php
session_start();
include 'config.php';

// Ensure only students can access this page
if ($_SESSION['role'] != 'student') {
    header("Location: login.html");
    exit();
}

$project_id = $_POST['project_id'];
$student_id = $_SESSION['user_id'];

$sql = "INSERT INTO project_members (student_id, project_id) VALUES ($student_id, $project_id)";
if ($conn->query($sql) === TRUE) {
    echo "You have successfully joined the project.";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>