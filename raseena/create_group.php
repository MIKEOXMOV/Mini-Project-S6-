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

// Get the group data from the POST request
$groupsData = $_POST['groups'];

// Loop through each group
foreach ($groupsData as $groupName => $groupMembers) {
    // Create a table for each group if it doesn't exist
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS $groupName (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        member_id INT(6) UNSIGNED,
        FOREIGN KEY (member_id) REFERENCES student(registerNo)
    )";
    if ($conn->query($sqlCreateTable) === FALSE) {
        echo "Error creating table: " . $conn->error;
    }

    // Insert group members into the table
    foreach ($groupMembers as $memberId) {
        $sqlInsertMember = "INSERT INTO $groupName (member_id) VALUES ($memberId)";
        if ($conn->query($sqlInsertMember) === FALSE) {
            echo "Error inserting group member: " . $conn->error;
        }
    }
}

$conn->close();

echo "Groups submitted successfully.";

?>
