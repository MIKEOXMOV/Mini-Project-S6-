<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the group ID and student ID from the POST request
$groupId = $_POST['group_id'];
$studentId = $_POST['student_id'];

// Example code to create a notification for each student in the group
$notificationMessage = "You have received a join request for group " . $groupId;

// Your code to insert notification into the database for each student in the group
// Example:
// - Retrieve students in the group from the database
// - For each student, insert a notification into the database
// - You may use a loop to achieve this

// Example SQL query to retrieve students in the group
$getStudentsSql = "SELECT student_id FROM student_groups WHERE group_id = $groupId";
$studentsResult = $conn->query($getStudentsSql);


if ($studentsResult->num_rows > 0) {
    while ($studentRow = $studentsResult->fetch_assoc()) {
        $studentId = $studentRow['student_id'];
        
        // Insert notification into the database for each student
        $insertNotificationSql = "INSERT INTO notifications (message, student_id, status) VALUES ('$notificationMessage', '$studentId', 'unread')";
        if ($conn->query($insertNotificationSql) !== TRUE) {
            echo "Error creating notification for student ID $studentId: " . $conn->error;
        }
    }
} else {
    echo "No students found in the group";
}

// Respond with a success message
echo "Join request sent successfully";

// Close the database connection
$conn->close();
?>
