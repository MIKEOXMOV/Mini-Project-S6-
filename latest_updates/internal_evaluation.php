<?php
// Database connection
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'project1';
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION['form_submitted'])) {
    // Start the session
    session_start();
    $_SESSION['form_submitted'] = true; // Set session variable to indicate form submission
    
    // Loop through the submitted data and insert into the database
    foreach ($_POST['student_id'] as $index => $student_id) {
        $attendance = mysqli_real_escape_string($conn, $_POST['attendance'][$index]);
        $guide_mark = mysqli_real_escape_string($conn, $_POST['guide_mark'][$index]);
        $report = mysqli_real_escape_string($conn, $_POST['report'][$index]);
        $evaluation = mysqli_real_escape_string($conn, $_POST['evaluation'][$index]);
        $total = mysqli_real_escape_string($conn, $_POST['total'][$index]);

        // SQL query to insert marks into the marks table
        $sql = "INSERT INTO marks (student_id, attendance, guide_mark, report, evaluation, total)
                VALUES ('$student_id', '$attendance', '$guide_mark', '$report', '$evaluation', '$total')";

        if (mysqli_query($conn, $sql)) {
            // Marks saved successfully
            echo "<script>alert('Marks saved successfully');</script>";
        } else {
            // Error saving marks
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}

// SQL query to retrieve student details (registerNo and name)
$sql = "SELECT registerNo, name FROM student ORDER BY name ASC";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Enter Marks</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="container">
            <h2>Enter Marks</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Attendance</th>
                            <th>Guide Mark</th>
                            <th>Report</th>
                            <th>Evaluation</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>".$row["registerNo"]."</td>";
                            echo "<td>".$row["name"]."</td>";
                            echo "<input type='hidden' name='student_id[]' value='".$row["registerNo"]."'>";
                            echo "<td><input type='number' name='attendance[]' min='0' max='10'></td>";
                            echo "<td><input type='number' name='guide_mark[]' min='0' max='15'></td>";
                            echo "<td><input type='number' name='report[]' min='0' max='10'></td>";
                            echo "<td><input type='number' name='evaluation[]' min='0' max='40'></td>";
                            echo "<td><input type='text' name='total[]' readonly></td>"; // Total field
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <input type="submit" value="Save Marks">
            </form>
        </div>
        <script>
            // JavaScript to calculate total marks for each student
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('input', () => {
                    const rows = form.querySelectorAll('tbody tr');
                    rows.forEach(row => {
                        const attendance = parseFloat(row.querySelector('input[name="attendance[]"]').value) || 0;
                        const guide_mark = parseFloat(row.querySelector('input[name="guide_mark[]"]').value) || 0;
                        const report = parseFloat(row.querySelector('input[name="report[]"]').value) || 0;
                        const evaluation = parseFloat(row.querySelector('input[name="evaluation[]"]').value) || 0;
                        const total = attendance + guide_mark + report + evaluation;
                        row.querySelector('input[name="total[]"]').value = total;
                    });
                });
            });
        </script>
    </body>
    </html>
    <?php
} else {
    echo "0 results";
}
mysqli_close($conn);
?>
