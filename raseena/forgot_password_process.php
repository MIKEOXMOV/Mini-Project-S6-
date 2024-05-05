<?php
// Establishing connection to MySQL
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "project1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieving email and new password from form
$pkd = $_POST['pkd'];
$newPassword = $_POST['newPassword'];

// Hashing the password (for better security)
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// Storing email and hashed password in the database
$sql = "UPDATE password SET Password='$hashedPassword' WHERE PKD='$pkd'";

if ($conn->query($sql) === TRUE) {
    echo "Password updated successfully";
} else {
    echo "Error updating password: " . $conn->error;
}

$conn->close();
?>
