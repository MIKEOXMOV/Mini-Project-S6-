
<?php
include 'db_connect.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input to prevent SQL injection
    $studentId = mysqli_real_escape_string($conn, $_POST['studentId']);
    $guideId = mysqli_real_escape_string($conn, $_POST['guideId']);
    
    // Prepare and bind the SQL statement
    $sql = "INSERT INTO requests (student_id, guide_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $studentId, $guideId);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Request submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
