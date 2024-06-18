<?php
// coordinator_evaluations.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ontrackify_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM coordinator_evaluations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<p><strong>Student ID:</strong> " . $row['student_id'] . "</p>";
        echo "<p><strong>Project ID:</strong> " . $row['project_id'] . "</p>";
        echo "<p><strong>Attendance:</strong> " . $row['attendance'] . "</p>";
        echo "<p><strong>Guide Marks:</strong> " . $row['guide_marks'] . "</p>";
        echo "<p><strong>Project Report:</strong> " . $row['project_report'] . "</p>";
        echo "<p><strong>Evaluation by Committee:</strong> " . $row['committee_evaluation'] . "</p>";
        echo "<p><strong>End Semester Demonstration:</strong> " . $row['end_sem_demo'] . "</p>";
        echo "<p><strong>End Semester Project Report:</strong> " . $row['end_sem_report'] . "</p>";
        echo "<p><strong>End Semester Viva Voce:</strong> " . $row['end_sem_viva'] . "</p>";
        echo "<p><strong>Total Marks:</strong> " . $row['total_marks'] . "</p>";
        echo "<p><strong>Comments:</strong> " . $row['comments'] . "</p>";
        echo "</div>";
    }
} else {
    echo "No evaluations found.";
}

$conn->close();
?>

