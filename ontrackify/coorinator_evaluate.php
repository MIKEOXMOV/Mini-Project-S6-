<?php
// coordinator_evaluate.php
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
    $attendance = $_POST['attendance'];
    $guide_marks = $_POST['guide_marks'];
    $project_report = $_POST['project_report'];
    $committee_evaluation = $_POST['committee_evaluation'];
    $end_sem_demo = $_POST['end_sem_demo'];
    $end_sem_report = $_POST['end_sem_report'];
    $end_sem_viva = $_POST['end_sem_viva'];
    $comments = $_POST['comments'];

    $total_marks = $attendance + $guide_marks + $project_report + $committee_evaluation + $end_sem_demo + $end_sem_report + $end_sem_viva;

    $sql = "INSERT INTO coordinator_evaluations (student_id, coordinator_id, project_id, attendance, guide_marks, project_report, committee_evaluation, end_sem_demo, end_sem_report, end_sem_viva, total_marks, comments)
    VALUES ($student_id, 1, $project_id, $attendance, $guide_marks, $project_report, $committee_evaluation, $end_sem_demo, $end_sem_report, $end_sem_viva, $total_marks, '$comments')"; // Assuming coordinator_id is 1 for simplicity

    if ($conn->query($sql) === TRUE) {
        echo "New evaluation recorded successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
