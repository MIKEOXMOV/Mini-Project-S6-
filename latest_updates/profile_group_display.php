<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['name'])) {
    header('location: login.php');
    exit(); // Terminate further execution
}

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'project1');

// Get the logged-in user's details
$name = $_SESSION['name'];
$query = "SELECT * FROM student WHERE name='$name'";
$result = mysqli_query($db, $query);
$student = mysqli_fetch_assoc($result);

// Fetch the group ID of the logged-in student
$groupIdQuery = "SELECT group_id FROM student_groups WHERE student_id = '" . $student['registerNo'] . "'";
$groupIdResult = mysqli_query($db, $groupIdQuery);
$groupIdData = mysqli_fetch_assoc($groupIdResult);
$groupId = $groupIdData['group_id'];

// Fetch group members based on the group ID
$groupMembersQuery = "SELECT * FROM student INNER JOIN student_groups ON student.registerNo = student_groups.student_id WHERE student_groups.group_id = '$groupId'";
$groupMembersResult = mysqli_query($db, $groupMembersQuery);

// Check if the logged-in student is in the group
$isStudentInGroup = false;
while ($row = mysqli_fetch_assoc($groupMembersResult)) {
    if ($row['name'] == $student['name']) {
        $isStudentInGroup = true;
        break;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        /* Reset default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Profile container styles */
        .profile-container {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
            margin-top:200px;
        }

        /* Profile title styles */
        .profile-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #555;
        }

        /* List styles */
        .profile-container ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        /* List item styles */
        .profile-container li {
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        /* Current user's list item style */
        .profile-container li.you {
            background-color: #3498db;
            color: #fff;
        }

        /* Hover effect */
        .profile-container li:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>Group Members</h2>
        <ul>
            <?php 
            // Reset result pointer
            mysqli_data_seek($groupMembersResult, 0);
            while ($row = mysqli_fetch_assoc($groupMembersResult)) : ?>
                <?php if ($row['name'] == $student['name']) : ?>
                    <li class="you">You (<?php echo $student['name']; ?>)</li>
                <?php else: ?>
                    <li><?php echo $row['name']; ?></li>
                <?php endif; ?>
            <?php endwhile; ?>
        </ul>
    </div>

    <!-- Include JavaScript -->
    <script src="profilegroup.js"></script>
</body>
</html>
