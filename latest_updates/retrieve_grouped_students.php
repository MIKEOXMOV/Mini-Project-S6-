<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Formation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        .group {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .group h3 {
            margin-top: 0;
            color: #333;
            font-size: 18px;
        }

        .group ul {
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
        }

        .group ul li {
            margin-bottom: 5px;
            color: #666;
        }

        .group button {
            padding: 8px 16px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .group button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <?php
    // Replace this with your database connection code
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve grouped students from the database
    $sql = "SELECT id FROM groups";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class='group'>";
            echo "<h3>Group {$row['id']}</h3>";
            echo "<ul>";
            // Fetch students for each group
            $students_sql = "SELECT student.name FROM student INNER JOIN student_groups ON student.registerNo = student_groups.student_id WHERE student_groups.group_id = {$row['id']}";
            $students_result = $conn->query($students_sql);
            while($student_row = $students_result->fetch_assoc()) {
                echo "<li>{$student_row['name']}</li>";
            }
            echo "</ul>";
            echo "<button onclick='sendJoinRequest({$row['id']})'>Send Join Request</button>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>

    <!-- Your JavaScript function for sending join requests goes here -->
    <script>
        function sendJoinRequest(groupId) {
            // Placeholder function for sending join requests
            alert("Join request sent for Group " + groupId);
        }
    </script>
</body>
</html>
