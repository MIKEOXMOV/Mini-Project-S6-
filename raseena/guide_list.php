<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Available Guides</h1>
        <?php
            // Connect to MySQL database
            $conn = mysqli_connect("localhost", "root", "", "project1");

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch teachers data
            $sql = "SELECT * FROM guide";
            $result = mysqli_query($conn, $sql);

            // Display teachers as table
            if (mysqli_num_rows($result) > 0) {
                echo "<table class='teacher-table'>";
                echo "<tr><th>Guide Name</th><th>Email Id</th></tr>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No teachers found";
            }

            // Close connection
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>
