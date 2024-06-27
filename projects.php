<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'coordinator') {
    header("Location: login.html");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "role_management";
$coordinator_id = $_SESSION['user_id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle create project
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_project'])) {
    $project_name = $_POST['project_name'];
    $semester = $_POST['semester'];
    $course_code = $_POST['course_code'];
    $sql = "INSERT INTO projects (name, semester, course_code, coordinator_id) VALUES ('$project_name', '$semester', '$course_code', $coordinator_id)";
    $conn->query($sql);
}

// Handle delete project
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_project'])) {
    $project_id = $_POST['project_id'];
    $sql = "DELETE FROM projects WHERE id = $project_id AND coordinator_id = $coordinator_id";
    $conn->query($sql);
}

// Handle edit project
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_project'])) {
    $project_id = $_POST['project_id'];
    $project_name = $_POST['project_name'];
    $semester = $_POST['semester'];
    $course_code = $_POST['course_code'];
    $sql = "UPDATE projects SET name = '$project_name', semester = '$semester', course_code = '$course_code' WHERE id = $project_id AND coordinator_id = $coordinator_id";
    $conn->query($sql);
}

// Fetch all projects for this coordinator
$sql = "SELECT * FROM projects WHERE coordinator_id = $coordinator_id";
$result = $conn->query($sql);
$projects = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinator Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your external CSS file -->
</head>
<body>
    <div class="container">
        <div class="header">Coordinator Dashboard</div>
        <h2>Create Project</h2>
        <form method="POST">
            <input type="text" name="project_name" placeholder="Project Name" required>
            <input type="text" name="semester" placeholder="Semester" required>
            <input type="text" name="course_code" placeholder="Course Code" required>
            <input type="submit" name="create_project" value="Create Project">
        </form>
    </div>

    <div class="container">
        <div class="header">Existing Projects</div>
        <table class="project-list">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Semester</th>
                    <th>Course Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?php echo $project['name']; ?></td>
                        <td><?php echo $project['semester']; ?></td>
                        <td><?php echo $project['course_code']; ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
                                <input type="text" name="project_name" value="<?php echo $project['name']; ?>" required>
                                <input type="text" name="semester" value="<?php echo $project['semester']; ?>" required>
                                <input type="text" name="course_code" value="<?php echo $project['course_code']; ?>" required>
                                <input type="submit" name="edit_project" value="Edit">
                                <input type="submit" name="delete_project" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
