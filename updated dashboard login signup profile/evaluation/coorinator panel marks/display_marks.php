<?php
session_start();
include 'config.php';

// Ensure only coordinators can access this page
if ($_SESSION['role'] != 'coordinator') {
    header("Location: login.html");
    exit();
}

// Fetch students' marks data
$marks_query = "SELECT u.name, u.register_or_faculty_id, sg.group_id, sm.attendance, gm.guide_marks, sm.project_report, sm.review1_total_marks, sm.review2_total_marks, sm.final_cie_mark
                FROM users u
                LEFT JOIN student_groups sg ON u.id = sg.student_id
                LEFT JOIN student_marks sm ON u.id = sm.student_id
                LEFT JOIN guide_marks gm ON u.id = gm.student_id AND sm.project_id = gm.project_id
                WHERE u.role = 'student'
                ORDER BY sg.group_id ASC";
$result = $conn->query($marks_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display Student Marks</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            margin-right: 10px;
        }
        .back-button {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="logo.png" width="40" height="40" class="d-inline-block align-top" alt="">
            OnTrackify
        </a>
        <a href="marks.php" class="btn btn-outline-primary back-button">Back</a>
    </nav>

    <div class="container mt-5">
        <h2>Student Marks</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Name</th>
                    <th>Register ID / Faculty ID</th>
                    <th>Group ID</th>
                    <th>Attendance (out of 10)</th>
                    <th>Guide Marks (out of 15)</th>
                    <th>Project Report (out of 10)</th>
                    <th>Review 1 Total Marks (out of 40)</th>
                    <th>Review 2 Total Marks (out of 40)</th>
                    <th>Total CIE Marks (out of 75)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $serial = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $serial++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['register_or_faculty_id']) . "</td>";
                    echo "<td>" . (isset($row['group_id']) ? htmlspecialchars($row['group_id']) : 'Not Assigned') . "</td>";
                    echo "<td>" . htmlspecialchars($row['attendance']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['guide_marks']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['project_report']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['review1_total_marks']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['review2_total_marks']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['final_cie_mark']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
