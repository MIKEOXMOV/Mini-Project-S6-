<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$projectName = $_POST["projectName"];
$description = $_POST["description"];
$groupMembers = $_POST["groupMembers"];
$contactNumber = $_POST["contactNumber"];
$references = $_POST["references"];

// Insert project details into database
$sql = "INSERT INTO prevprojects (projectName, description, groupMembers, contactNumber, `references`)
        VALUES ('$projectName', '$description', '$groupMembers', '$contactNumber', '$references')";

if ($conn->query($sql) === TRUE) {
    echo "Project details uploaded successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close MySQL connection
$conn->close();
?>
