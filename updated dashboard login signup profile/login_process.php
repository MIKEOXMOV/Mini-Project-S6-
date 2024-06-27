<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "role_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$identifier = $_POST['identifier'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$identifier' OR register_or_faculty_id='$identifier'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        if ($row['role'] == 'student') {
            header("Location: student_panel.php");
        } elseif ($row['role'] == 'coordinator') {
            header("Location: coordinator_panel.php");
        } elseif ($row['role'] == 'guide') {
            header("Location: guide_panel.php");
        } else {
            echo "Access denied.";
        }
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with this email or register number.";
}

$conn->close();
?>
