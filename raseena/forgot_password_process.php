<?php

// Include your database connection file here
// Example: include 'db_connection.php';

// Check if username and new password are set and not empty
if(isset($_POST['type'],$_POST['pkd'], $_POST['newPassword']) && !empty($_POST['pkd']) && !empty($_POST['newPassword'])) {
  $pkd = $_POST['pkd'];
  $newPassword = $_POST['newPassword'];
  $type = $_POST['type'];

// Establishing connection to MySQL
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "project1";

// Create connection
$db_connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}



// Hashing the password (for better security)
$password = md5($newPassword);

// Storing email and hashed password in the database
if($type == "guide"){
    $sql = "UPDATE guide SET password='$password' WHERE id='$pkd'";
}elseif($type == "coordinator"){
    $sql = "UPDATE coordinator SET password='$password' WHERE id='$pkd'";
}elseif($type == "student"){
    $sql = "UPDATE student SET password='$password' WHERE registerNo='$pkd'";
}
if ($db_connection->query($sql) === TRUE) {
    echo json_encode(array("success" => true, "message" => "Password updated successfully!"));
  } else {
    echo json_encode(array("success" => false, "message" => "Error updating password: " . $db_connection->error));
  }
  
  $db_connection->close();
  
} else {
  echo json_encode(array("success" => false, "message" => "Username or new password not provided."));
}
?>
