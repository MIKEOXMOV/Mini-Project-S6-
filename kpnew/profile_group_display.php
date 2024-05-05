
    
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        /* Profile container styles */
        .profile-container {
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        }
    </style>
    <!-- Include CSS -->
</head>
<body>
    <div class="profile-container">
        <h2>Group Members</h2>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($groupMembersResult)) : ?>
                <li><?php echo $row['name']; ?></li>
            <?php endwhile; ?>
            <!-- Display the current student -->
            <li>You (<?php echo $student['name']; ?>)</li>
        </ul>
    </div>

    <!-- Include JavaScript -->
    <script src="profilegroup.js"></script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($db);
?>
