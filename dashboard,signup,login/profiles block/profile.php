<?php
session_start(); // Start session if not already started

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "role_management"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data based on session user ID
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, fetch and display user details
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $email = $row["email"];
    $register_or_faculty_id = $row["register_or_faculty_id"];
    $role = $row["role"];
} else {
    echo "User not found.";
    exit(); // Exit if user not found
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>User Profile</h2>
        <p>Name: <?php echo $name; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <p>Register Number/Faculty ID: <?php echo $register_or_faculty_id; ?></p>
        <p>Role: <?php echo $role; ?></p>
        <hr>
        <h4>Edit Additional Details</h4>
        <div id="updateForm">
            <form method="post" action="update_profile.php">
                <!-- Include fields for editing existing details -->
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="form-group">
                    <label for="register_or_faculty_id">Register Number/Faculty ID:</label>
                    <input type="text" class="form-control" id="register_or_faculty_id" name="register_or_faculty_id" value="<?php echo $register_or_faculty_id; ?>">
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <input type="text" class="form-control" id="role" name="role" value="<?php echo $role; ?>" readonly>
                </div>
                <!-- Include fields for updating additional details -->
                <div class="form-group">
                    <label for="department">Department:</label>
                    <input type="text" class="form-control" id="department" name="department">
                </div>
                <div class="form-group">
                    <label for="semester">Semester:</label>
                    <input type="text" class="form-control" id="semester" name="semester">
                </div>
                <div class="form-group">
                    <label for="college_name">College Name:</label>
                    <input type="text" class="form-control" id="college_name" name="college_name">
                </div>
                <div class="form-group">
                    <label for="batch">Batch:</label>
                    <input type="text" class="form-control" id="batch" name="batch">
                </div>
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" onclick="cancelUpdate()">Cancel</button>
            </form>
        </div>
    </div>

    <!-- JavaScript to toggle form visibility -->
    <script>
        function cancelUpdate() {
            document.getElementById("updateForm").reset();
        }
    </script>
</body>
</html>
