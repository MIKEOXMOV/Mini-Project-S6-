<?php
session_start(); // Start session if not already started

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
include_once('db_connection.php');

// Fetch user's additional details from the profile_details table
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM profile_details WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, fetch and display additional details
    $row = $result->fetch_assoc();
    $department = $row["department"];
    $semester = $row["semester"];
    $batch = $row["batch"];
    $college_name = $row["college_name"];
} else {
    echo "Additional details not found.";
    exit(); // Exit if additional details not found
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Profile</h2>
        <form method="post" action="update_profile.php">
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" class="form-control" id="department" name="department" value="<?php echo $department; ?>">
            </div>
            <div class="form-group">
                <label for="semester">Semester:</label>
                <input type="text" class="form-control" id="semester" name="semester" value="<?php echo $semester; ?>">
            </div>
            <div class="form-group">
                <label for="batch">Batch:</label>
                <input type="text" class="form-control" id="batch" name="batch" value="<?php echo $batch; ?>">
            </div>
            <div class="form-group">
                <label for="college_name">College Name:</label>
                <input type="text" class="form-control" id="college_name" name="college_name" value="<?php echo $college_name; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>
</html>
