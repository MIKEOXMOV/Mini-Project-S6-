<?php

// Connect to MySQL database (replace with your credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch students from the database
$sql = "SELECT * FROM student";
$result = $conn->query($sql);

$students = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $students[] = array('id' => $row['registerNo'], 'name' => $row['name']);
    }
} else {
    echo "0 results";
}

$conn->close();

// Return students as JSON
header('Content-Type: application/json');
echo json_encode($students);
?>
