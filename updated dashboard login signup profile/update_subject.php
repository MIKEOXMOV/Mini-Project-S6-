<?php
// update_subject.php

// Include your database connection here
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "role_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind SQL statement
$stmt = $conn->prepare("UPDATE subjects SET code=?, name=?, semester=?, department=?, batch=?, students_limit=?, description=?, coordinator_id=? WHERE id=?");
$stmt->bind_param("sssssisii", $code, $name, $semester, $department, $batch, $students_limit, $description, $coordinator_id, $id);

// Set parameters from POST data
$id = $_POST['id'];
$code = $_POST['code'];
$name = $_POST['name'];
$semester = $_POST['semester'];
$department = $_POST['department'];
$batch = $_POST['batch'];
$students_limit = $_POST['students_limit'];
$description = $_POST['description'];
$coordinator_id = $_POST['coordinator_id'];

// Execute SQL statement
if ($stmt->execute()) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
