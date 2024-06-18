<?php
// guide_evaluate.php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $project_id = $_POST['project_id'];
    $work_upload = $_POST['work_upload'];
    $teamwork = $_POST['teamwork'];
    $performance = $_POST['performance'];
    $comments = $_POST['comments'];

    $total_marks = $work_upload + $teamwork + $performance;

    $sql = "INSERT INTO guide_evaluations (student_id, guide_id, project_id, work_upload, teamwork, performance, total_marks, comments)
    VALUES ($student_id, 1, $project_id, $work_upload, $teamwork, $performance, $total_marks, '$comments')"; // Assuming guide_id is 1 for simplicity

    if ($conn->query($sql) === TRUE) {
        echo "New evaluation recorded successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
