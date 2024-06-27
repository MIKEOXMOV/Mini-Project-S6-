<?php
session_start();
include 'config.php';

// Ensure only coordinators can access this page
if ($_SESSION['role'] != 'coordinator') {
    header("Location: login.html");
    exit();
}

$project_id = $_GET['project_id'];

// Fetch project details
$project_query = "SELECT * FROM projects WHERE id = $project_id";
$project_result = $conn->query($project_query);
$project = $project_result->fetch_assoc();

// Fetch students associated with the project
$students_query = "SELECT users.id, users.name, users.email 
                   FROM users 
                   INNER JOIN project_members ON users.id = project_members.student_id 
                   WHERE project_members.project_id = $project_id";
$students_result = $conn->query($students_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Students</title>
</head>
<body>
    <h1>Project: <?php echo htmlspecialchars($project['name']); ?></h1>
    <h2>Semester: <?php echo htmlspecialchars($project['semester']); ?></h2>
    <h3>Course Code: <?php echo htmlspecialchars($project['course_code']); ?></h3>
    
    <h2>Students in this Project</h2>
    <?php if ($students_result->num_rows > 0): ?>
        <ol>
            <?php while ($student = $students_result->fetch_assoc()): ?>
                <li><?php echo htmlspecialchars($student['name']); ?> (<?php echo htmlspecialchars($student['email']); ?>)</li>
            <?php endwhile; ?>
        </ol>
    <?php else: ?>
        <p>No students have joined this project yet.</p>
    <?php endif; ?>
</body>
</html>
