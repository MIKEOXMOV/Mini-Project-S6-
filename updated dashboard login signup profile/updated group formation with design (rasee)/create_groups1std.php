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
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: white;
            color: black;
            padding: 10px 20px;
            border-bottom: 1px solid #ccc;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 50px; /* Adjust as per your logo size */
            height: auto;
            margin-right: 10px;
        }

        .logo span {
            font-size: 1.5rem; /* Adjust as needed */
            font-weight: bold;
        }

        .back-button {
            background-color: #0056b3;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #00408a;
        }

        .content {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #f9f9f9;
        }

        .student-list {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: white;
        }

        .student-list h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
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
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white;
        }

        .group-form label {
            display: block;
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #333;
        }

        .group-form input[type="number"],
        .group-form button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .group-form button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .group-form button:hover {
            background-color: #0056b3;
        }

        ol {
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="logo.png" alt="Logo">
            <span>OnTrackify</span>
        </div>
        <a href="create_groups1.php" class="back-button">Back</a>
    </div>

    <div class="content">
        <h3>Create Groups for Project</h3>
        <div class="student-list">
            <h3>Students</h3>
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
    </div>
</body>
</html>
