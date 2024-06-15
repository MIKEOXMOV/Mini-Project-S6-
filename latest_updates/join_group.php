<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['name'])) {
    header('location: login.php');
    exit(); // Terminate further execution
}

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'project1');

// Get the logged-in user's details
$name = $_SESSION['name'];
$query = "SELECT * FROM student WHERE name='$name'";
$result = mysqli_query($db, $query);
$student = mysqli_fetch_assoc($result);

// Get the group ID student wants to join (assuming it comes from a form)
if (isset($_POST['join_group'])) {
    $groupId = $_POST['group_id']; // Adjust this based on your form
    
    // Redirect the student to the group interface associated with their group ID
    header("Location: group_interface.php?group_id=$groupId");
    exit(); // Terminate further execution
}

// Close the database connection
mysqli_close($db);
?>
