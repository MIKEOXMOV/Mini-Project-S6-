<?php


// Connect to the database (replace with your database credentials)
$conn = new mysqli('localhost', 'root', '', 'project1');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch guides
$sql = "SELECT * FROM guide";
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Check if any guides are found
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['name']}</td><td><button class='request-btn' data-guide-id='{$row['id']}'>Request</button></td></tr>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
