<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Formation</title>
    <link rel="stylesheet" href="groupstyle.css">
</head>
<body>
    <div class="container">
        <h1>Group Formation</h1>
        <div class="students-list">
            <h2>All Students</h2>
            <div id="studentList">
                <?php
                // Database connection parameters
                $servername = "localhost";
                $username = "root"; // Replace with your database username
                $password = ""; // Replace with your database password
                $dbname = "project1"; // Replace with your database name

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Retrieve student details from the database
                $sql = "SELECT registerNo, name FROM student";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="student">';
                        echo '<p>Name: ' . $row["name"] . '</p>';
                        echo '<form action="process_group.php" method="post">';
                        echo '<input type="hidden" name="student_id" value="' . $row["registerNo"] . '">';
                        echo '<input type="submit" value="Add">';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo "No students found.";
                }

                // Close MySQL connection
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>
</html>
