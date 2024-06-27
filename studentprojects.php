<?php
session_start();
include 'config.php';

// Ensure only students can access this page
if ($_SESSION['role'] != 'student') {
    header("Location: login.html");
    exit();
}

// Fetch distinct semesters available for projects
$semester_query = "SELECT DISTINCT semester FROM projects";
$semester_result = $conn->query($semester_query);

$selected_semester = '';
$projects = [];

// Fetch projects based on selected semester
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selected_semester = $_POST['semester'];
    $project_query = "SELECT * FROM projects WHERE semester = '$selected_semester'";
    $project_result = $conn->query($project_query);

    while ($project = $project_result->fetch_assoc()) {
        $projects[] = $project;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Semester and View Projects</title>
</head>
<body>
    <h1>Select Semester</h1>
    <form method="POST" action="">
        <label for="semester">Semester:</label>
        <select name="semester" id="semester" required>
            <option value="">Select Semester</option>
            <?php while ($row = $semester_result->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($row['semester']); ?>" <?php if ($row['semester'] == $selected_semester) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($row['semester']); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Show Projects</button>
    </form>

    <?php if (!empty($projects)): ?>
        <h2>Projects for Semester: <?php echo htmlspecialchars($selected_semester); ?></h2>
        <?php foreach ($projects as $project): ?>
            <div>
                <h3><?php echo htmlspecialchars($project['name']); ?></h3>
                <p>Course Code: <?php echo htmlspecialchars($project['course_code']); ?></p>
                <form action="join_project.php" method="POST">
                    <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
                    <button type="submit">Join Project</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <p>No projects available for the selected semester.</p>
    <?php endif; ?>
</body>
</html>
