<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "project_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $courseCode = $_POST['courseCode'];
        $courseName = $_POST['courseName'];
        $coordinatorName = $_POST['coordinatorName'];
        $batch = $_POST['batch'];
        $semester = $_POST['semester'];

        // Prepare SQL statement
        $sql = "INSERT INTO projects (course_code, course_name, coordinator_name, batch, semester) 
                VALUES ('$courseCode', '$courseName', '$coordinatorName', '$batch', '$semester')";

        if ($conn->query($sql) === TRUE) {
            echo "New project added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        
        // Prepare delete SQL statement
        $sql = "DELETE FROM projects WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Project deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $courseCode = $_POST['courseCode'];
        $courseName = $_POST['courseName'];
        $coordinatorName = $_POST['coordinatorName'];
        $batch = $_POST['batch'];
        $semester = $_POST['semester'];

        // Prepare update SQL statement
        $sql = "UPDATE projects SET course_code='$courseCode', course_name='$courseName', coordinator_name='$coordinatorName', batch='$batch', semester='$semester' 
                WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Project updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>

<form id="addProjectForm" action="add_project.php" method="post">
    <label for="id">Project ID (for edit/delete):</label>
    <input type="text" id="id" name="id"><br><br>
    <label for="courseCode">Course Code:</label>
    <input type="text" id="courseCode" name="courseCode" required><br><br>
    <label for="courseName">Course Name:</label>
    <input type="text" id="courseName" name="courseName" required><br><br>
    <label for="coordinatorName">Coordinator Name:</label>
    <input type="text" id="coordinatorName" name="coordinatorName" required><br><br>
    <label for="batch">Batch:</label>
    <input type="text" id="batch" name="batch" required><br><br>
    <label for="semester">Semester:</label>
    <input type="text" id="semester" name="semester" required><br><br>
    <button type="submit" name="submit">Submit</button>
    <button type="submit" name="edit">Edit</button>
    <button type="submit" name="delete">Delete</button>
    <button type="button" class="cancel-btn" id="cancelBtn">Back</button>
</form>

<script>
    document.getElementById('cancelBtn').addEventListener('click', function() {
        window.history.back();
    });
</script>
