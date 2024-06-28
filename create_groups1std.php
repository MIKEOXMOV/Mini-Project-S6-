<?php
session_start();

// Redirect if user is not logged in as coordinator
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'coordinator') {
    header("Location: login.php");
    exit();
}

include 'config.php';

$project_id = $_GET['project_id'];

// Fetch students who have joined the project
$query = "
SELECT u.id, u.name 
FROM users u 
JOIN project_members pm ON u.id = pm.student_id 
WHERE pm.project_id = ? AND u.role = 'student'";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
$students = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Groups</title>
    <link rel="stylesheet" href="stdstyle.css">
    <style>
        body {
            background-color: white;
            font-family: Arial, sans-serif;
        }
        .student-list {
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .student-item {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white;
        }

        .group-form {
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        ol {
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <h1>Create Groups for Project</h1>
    <div class="student-list">
        <h2>Students</h2>
        <ol>
            <?php foreach ($students as $student): ?>
                <li class="student-item">
                    <?= htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8') ?>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
    <div class="group-form">
        <form action="process_create_groups.php" method="POST">
            <input type="hidden" name="project_id" value="<?= htmlspecialchars($project_id, ENT_QUOTES, 'UTF-8') ?>">
            <label for="group_size">Group Size:</label>
            <input type="number" name="group_size" min="1" required>
            <button type="submit">Create Groups</button>
        </form>
    </div>
</body>
</html>
