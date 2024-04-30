<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch student data
$sql = "SELECT registerNo, name FROM student";
$result = $conn->query($sql);

// Array to store student data
$students = array();

// Check if there are any results
if ($result->num_rows > 0) {
    // Fetch each row and add it to the $students array
    while($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
} else {
    // No students found
    echo json_encode(array("error" => "No students found"));
}

// Close the connection
$conn->close();

// Convert array to JSON and output it
echo json_encode($students);
?>
