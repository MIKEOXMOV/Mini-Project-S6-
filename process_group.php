<?php
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the selected student IDs from the request
    $student_ids_json = $_POST["student_ids"];
    $student_ids = json_decode($student_ids_json);

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = ""; // Your MySQL password
    $dbname = "project1"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        $response = array("success" => false, "message" => "Connection failed: " . $conn->connect_error);
        echo json_encode($response);
        exit;
    }

    // Insert the group into the database
    $sql = "INSERT INTO groups (id) VALUES (DEFAULT)";
    if ($conn->query($sql) === TRUE) {
        // Get the group ID of the newly inserted group
        $group_id = $conn->insert_id;

        // Insert the students into the group_students table
        foreach ($student_ids as $student_id) {
            $sql = "INSERT INTO student_groups (group_id, student_id) VALUES ($group_id, '$student_id')";
            if ($conn->query($sql) !== TRUE) {
                $response = array("success" => false, "message" => "Error inserting student into group: " . $conn->error);
                echo json_encode($response);
                $conn->close();
                exit;
            }
        }

        // Return success response
        $response = array("success" => true, "message" => "Group formed successfully!");
        echo json_encode($response);
    } else {
        // Return error response
        $response = array("success" => false, "message" => "Error forming group: " . $conn->error);
        echo json_encode($response);
    }

    // Close connection
    $conn->close();
}
?>
