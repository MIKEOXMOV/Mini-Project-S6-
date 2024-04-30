<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['name'])) {
    header('location: login.php');
}

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'project1');

// Get the logged-in user's details
$name = $_SESSION['name'];
$query = "SELECT * FROM student WHERE name='$name'";
$result = mysqli_query($db, $query);
$student = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- Add your CSS stylesheets here -->
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>

   <!--  <h1>Welcome to Student Dashboard, <?php echo $student['name']; ?>!</h1>

    <div class="student-details">
        <h2>Your Details:</h2>
        <p><strong>Name:</strong> <?php echo $student['name']; ?></p>
        <p><strong>Register Number:</strong> <?php echo $student['registerNo']; ?></p>
        <p><strong>Semester:</strong> <?php echo $student['sem']; ?></p>
        <p><strong>Email:</strong> <?php echo $student['email']; ?></p>-->
        <!-- Add more details here as needed -->
    </div>

    <!-- Add your HTML content here -->

    <!-- Add your JavaScript scripts here -->


</body>
</html>
