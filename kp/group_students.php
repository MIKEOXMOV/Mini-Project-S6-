<?php
if(isset($_GET['groupSize'])) {
    $groupSize = $_GET['groupSize'];
    
    // Connect to MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "project1";

    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to select all students
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Group students based on user input group size
        $groups = [];
        $groupIndex = 0;

        while ($row = $result->fetch_assoc()) {
            $groups[$groupIndex][] = $row;
            $groupIndex = ($groupIndex + 1) % $groupSize;
        }

        // Display grouped students
        foreach ($groups as $groupIndex => $group) {
            echo "<h2>Group " . ($groupIndex + 1) . "</h2>";
            echo "<ul>";
            foreach ($group as $student) {
                echo "<li>" . $student['name'] . "</li>";
            }
            echo "</ul>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
} else {
    echo "Please enter a group size.";
}
?>
