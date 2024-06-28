<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'coordinator') {
    header("Location: login.php");
    exit();
}

include 'config.php';

$coordinator_id = $_SESSION['user_id'];

// Fetch projects created by the coordinator
$query = "SELECT id, name FROM projects WHERE coordinator_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $coordinator_id);
$stmt->execute();
$result = $stmt->get_result();
$projects = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinator Dashboard</title>
    <link rel="stylesheet" href="stdstyle.css">
    <style>
        .project-list {
            margin-top: 20px;
        }

        .project-item {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .project-item a {
            text-decoration: none;
            color: #000;
        }
    </style>
</head>
<body>
    <h1>Coordinator Dashboard</h1>
    <div class="project-list">
        <h2>Your Projects</h2>
        <?php foreach ($projects as $project): ?>
            <div class="project-item">
                <a href="create_groups1std.php?project_id=<?= $project['id'] ?>"><?= $project['name'] ?></a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
