<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

// Fetch group_id for the student
$student_id = $_SESSION['user_id'];
$group_id = null; // Initialize $group_id

$groupQuery = "SELECT group_id FROM group_members WHERE student_id = '$student_id'";
$groupResult = mysqli_query($conn, $groupQuery);

if ($groupResult && mysqli_num_rows($groupResult) > 0) {
    $row = mysqli_fetch_assoc($groupResult);
    $group_id = $row['group_id'];
}

// Query to fetch guides
$query = "SELECT id, name FROM users WHERE role = 'guide'";
$result = mysqli_query($conn, $query);

$guides = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $guides[] = $row;
    }
}

// Handle form submission to send request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guide_id'])) {
    $guide_id = mysqli_real_escape_string($conn, $_POST['guide_id']);
    
    // Check if a request already exists
    $checkQuery = "SELECT * FROM requests WHERE student_id = '$student_id' AND guide_id = '$guide_id' AND group_id = '$group_id'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) == 0) {
        $sql = "INSERT INTO requests (student_id, guide_id, group_id, status) VALUES ('$student_id', '$guide_id', '$group_id', 'pending')";
        if (mysqli_query($conn, $sql)) {
            // Redirect to success page
            header("Location: request_success.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "You have already requested this guide for this group.";
    }
}

// Fetch requests status
$statuses = [];
$statusQuery = "SELECT guide_id, group_id, status FROM requests WHERE student_id = '$student_id'";
$statusResult = mysqli_query($conn, $statusQuery);
if ($statusResult && mysqli_num_rows($statusResult) > 0) {
    while ($row = mysqli_fetch_assoc($statusResult)) {
        $statuses[$row['guide_id']][$row['group_id']] = $row['status'];
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Guides</title>
    <!-- Include any necessary CSS stylesheets -->
    <link rel="stylesheet" href="styles.css">
    <style>
        .guide-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .guide-table th, .guide-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .guide-table th {
            background-color: #f2f2f2;
        }
        .guide-table button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .guide-table button:hover {
            background-color: #45a049;
        }
        .back-button {
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .logo-name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="logo.png" alt="Logo">
            <div class="logo-name">OnTrackify</div>
        </div>
        <a href="group_panel.php" class="back-button">Back</a>
    </div>

    <h1>List of Available Guides</h1>

    <div id="guideList">
        <table class="guide-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($guides as $guide): ?>
                    <tr>
                        <td><?php echo $guide['id']; ?></td>
                        <td><?php echo htmlspecialchars($guide['name']); ?></td>
                        <td>
                            <?php if (isset($statuses[$guide['id']][$group_id])): ?>
                                <?php echo ucfirst($statuses[$guide['id']][$group_id]); ?>
                            <?php else: ?>
                                Not requested
                            <?php endif; ?>
                        </td>
                        <td>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="hidden" name="guide_id" value="<?php echo $guide['id']; ?>">
                                <?php if (isset($statuses[$guide['id']][$group_id]) && $statuses[$guide['id']][$group_id] == 'pending'): ?>
                                    <button type="button" disabled>Request Pending</button>
                                <?php elseif (isset($statuses[$guide['id']][$group_id]) && $statuses[$guide['id']][$group_id] == 'approved'): ?>
                                    <button type="button" disabled>Approved</button>
                                <?php elseif (isset($statuses[$guide['id']][$group_id]) && $statuses[$guide['id']][$group_id] == 'rejected'): ?>
                                    <button type="button" disabled>Rejected</button>
                                <?php else: ?>
                                    <button type="submit">Request Guide</button>
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Include any necessary JavaScript files -->
    <script src="script.js"></script>
</body>
</html>
