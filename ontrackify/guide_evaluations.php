<?php
// guide_evaluations.php
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

$sql = "SELECT * FROM guide_evaluations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<p><strong>Student ID:</strong> " . $row['student_id'] . "</p>";
        echo "<p><strong>Project ID:</strong> " . $row['project_id'] . "</p>";
        echo "<p><strong>Work Upload:</strong> " . $row['work_upload'] . "</p>";
        echo "<p><strong>Teamwork:</strong> " . $row['teamwork'] . "</p>";
        echo "<p><strong>Performance:</strong> " . $row['performance'] . "</p>";
        echo "<p><strong>Total Marks:</strong> " . $row['total_marks'] . "</p>";
        echo "<p><strong>Comments:</strong> " . $row['comments'] . "</p>";
        echo "</div>";
    }
} else {
    echo "No evaluations found.";
}

$conn->close();
?>
