<?php


// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

// Process the request
// Your code to handle the POST request and add the event to the database goes here




// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the JSON data from the request body
    $json_data = file_get_contents("php://input");

    // Decode the JSON data into an associative array
    $event_data = json_decode($json_data, true);

    // Check if all required fields are present
    if (!empty($event_data['date']) && !empty($event_data['title'])) {
        // Extract event data
        $date = $event_data['date'];
        $title = $event_data['title'];
        $description = isset($event_data['description']) ? $event_data['description'] : '';

        // Optionally, you can perform validation and sanitization of the data here
        
        // Connect to your database and insert the event data
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "project1";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO events (event_date, title, description) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $date, $title, $description);

        // Execute SQL statement
        if ($stmt->execute()) {
            // Event added successfully
            echo "Event added successfully!";
        } else {
            // Error occurred while adding event
            http_response_code(500);
            echo "Error adding event: " . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Return an error response if required fields are missing
        http_response_code(400);
        echo "All fields are required!";
    }
} else {
    // Return an error response if the request method is not POST
    http_response_code(405);
    echo "Method Not Allowed";
}
?>
