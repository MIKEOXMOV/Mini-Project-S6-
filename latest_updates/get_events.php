<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'project 1';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Handle connection errors
    echo json_encode(array("error" => "Database connection failed: " . $e->getMessage()));
    exit();
}

// Prepare and execute the SQL statement to fetch events
$stmt = $pdo->prepare("SELECT * FROM events");
$stmt->execute();

// Fetch all events as an associative array
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return events as JSON
echo json_encode($events);
?>