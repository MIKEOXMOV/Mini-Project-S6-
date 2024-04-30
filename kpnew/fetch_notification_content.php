<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['name'])) {
    header('location: login.php');
    exit(); // Terminate further execution
}

// Database connection
$db = mysqli_connect('localhost', 'root', '', 'project1');

// Get the logged-in user's name from the session
$name = $_SESSION['name'];

// Fetch the student's details
$query = "SELECT * FROM student WHERE name='$name'";
$result = mysqli_query($db, $query);
$student = mysqli_fetch_assoc($result);

// Fetch notifications for the logged-in student using their student ID
$studentId = $student['registerNo']; // Assuming this is the column name in the student table
$sql = "SELECT id, message, status, created_at FROM notifications WHERE student_id = '$studentId' ORDER BY created_at DESC";
$result = mysqli_query($db, $sql);

// Check if there are any notifications
if (mysqli_num_rows($result) > 0) {
    // Loop through each notification
    while ($row = mysqli_fetch_assoc($result)) {
        $notificationId = $row['id'];
        $message = $row['message'];
        $status = $row['status'];
        $createdAt = $row['created_at'];

        // Display the notification message
        echo "<div class='notification'>";
        echo "<p class='message'>$message</p>";
        echo "<p class='status'>Status: $status</p>";
        echo "<p class='created-at'>Created at: $createdAt</p>";

        // Add a button to mark the notification as read (if it's unread)
        if ($status === 'unread') {
            echo "<form action='mark_notification_read.php' method='POST'>";
            echo "<input type='hidden' name='notification_id' value='$notificationId'>";
            echo "<button type='submit'>Mark as Read</button>";
            echo "</form>";
        }
        echo "</div>";
    }
} else {
    echo "No notifications found.";
}

// Close the database connection
mysqli_close($db);
?>
