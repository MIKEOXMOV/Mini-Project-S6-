<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'project1';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Handle connection errors
    http_response_code(500);
    echo json_encode(array("message" => "Database connection failed: " . $e->getMessage()));
    exit();
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the JSON data from the request body
    $json_data = file_get_contents("php://input");

    // Decode the JSON data into an associative array
    $data = json_decode($json_data);

    // Get the event ID from the data
    $eventId = $data->id;

    // Prepare and execute the SQL statement to delete the event
    $stmt = $pdo->prepare("DELETE FROM events WHERE id = :id");
    $stmt->bindParam(':id', $eventId, PDO::PARAM_INT);

    try {
        if ($stmt->execute()) {
            // Event deleted successfully
            http_response_code(200);
            echo json_encode(array("message" => "Most recent event deleted successfully."));
        } else {
            // Failed to delete event
            http_response_code(500);
            echo json_encode(array("message" => "Unable to delete most recent event."));
        }
    } catch(PDOException $e) {
        // Handle database errors
        http_response_code(500);
        echo json_encode(array("message" => "Database error: " . $e->getMessage()));
    }
} else {
    // Return an error response if the request method is not POST
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
