<?php
// Establish connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO ideas (student_name, idea) VALUES (?, ?)");

    $stmt->bind_param("ss", $studentName, $idea);

    // Set parameters and execute for each idea submission
    for ($i = 1; $i <= 4; $i++) {
        $studentName = $_POST["studentName$i"];
        $idea = $_POST["idea$i"];

        $stmt->execute();
    }

    echo "Ideas submitted successfully";
    
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
