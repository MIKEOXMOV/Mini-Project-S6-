<?php
// Replace this with your database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve grouped students from the database
$sql = "SELECT id FROM groups";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='group'>";
        echo "<h3>{$row['id']}</h3>";
        echo "<ul>";
        // Fetch students for each group
        $students_sql = "SELECT student.name FROM student INNER JOIN student_groups ON student.registerNo = student_groups.student_id WHERE student_groups.group_id = {$row['id']}";
        $students_result = $conn->query($students_sql);
        while($student_row = $students_result->fetch_assoc()) {
            echo "<li>{$student_row['name']}</li>";
        }
        echo "</ul>";
        echo "<button onclick='sendJoinRequest({$row['id']})'>Send Join Request</button>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
