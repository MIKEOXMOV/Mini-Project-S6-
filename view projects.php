<?php
session_start();
include 'config.php';

// Ensure only coordinators can access this page
if ($_SESSION['role'] != 'coordinator') {
    header("Location: login.html");
    exit();
}

$coordinator_id = $_SESSION['user_id'];

// Fetch projects created by the logged-in coordinator
$projects_query = "SELECT * FROM projects WHERE coordinator_id = $coordinator_id";
$projects_result = $conn->query($projects_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coordinator Dashboard</title>
</head>
<body>
    <h1>Coordinator Dashboard</h1>
    <h2>Your Projects</h2>
    <ul>
        <?php while ($project = $projects_result->fetch_assoc()): ?>
            <li>
                <h3><?php echo htmlspecialchars($project['name']); ?> (<?php echo htmlspecialchars($project['semester']); ?>)</h3>
                <p>Course Code: <?php echo htmlspecialchars($project['course_code']); ?></p>
                <form action="view_project_members.php" method="GET">
                    <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
                    <button type="submit">View Students</button>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
