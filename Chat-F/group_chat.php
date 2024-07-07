<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "role_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sender_id = $_SESSION['user_id'];
$group_id = $_GET['group_id'];

// Fetch group messages with sender's username and register_or_faculty_id
$messagesQuery = "
    SELECT m.*, u.name AS sender_name, u.register_or_faculty_id 
    FROM messages m
    JOIN users u ON m.sender_id = u.id
    WHERE m.group_id = ?
    ORDER BY m.created_at ASC
";
$stmt = $conn->prepare($messagesQuery);
$stmt->bind_param("i", $group_id);
$stmt->execute();
$result = $stmt->get_result();
$messages = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];

    // Insert new group message
    $insertMessageQuery = "INSERT INTO messages (sender_id, group_id, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertMessageQuery);
    $stmt->bind_param("iis", $sender_id, $group_id, $message);
    $stmt->execute();
    $stmt->close();

    // Redirect to avoid resubmission on page refresh
    header("Location: group_chat.php?group_id=" . $group_id);
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Group Chat</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>

        /* General Styles */
h1, h2 {
    color: #333;
}

a {
    color: #007BFF;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Container */
.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    margin-top: 20px;
}

/* Chat Styles */
.chat-box {
    border: 1px solid #ddd;
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 8px;
    margin-bottom: 10px;
}

.chat-box strong {
    color: #007BFF;
}

textarea {
    width: 100%;
    height: 100px;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

button {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

/* Group and Members List */
ul {
    list-style: none;
    padding: 0;
}

ul li {
    background-color: #f1f1f1;
    margin: 5px 0;
    padding: 10px;
    border-radius: 4px;
}

ul li a {
    float: right;
    padding: 5px 10px;
    background-color: #007BFF;
    color: #fff;
    border-radius: 4px;
}

ul li a:hover {
    background-color: #0056b3;
}

/* Form Styles */
form {
    margin-top: 20px;
}

        /* Additional styles for group chat */
        .chat-box.sent {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
    </style>
</head>
<body>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="notification" id="notificationBell">
                <i class="uil uil-bell"></i>
                <span class="badge" id="notificationBadge"><?php echo $notification_count; ?></span>
                <div id="notificationsList"></div>
            </div>
            <img src="images/profile.jpg" alt="Profile Picture">
        </div>
    </section>    
    <section>
<div class="container">
    <h1>Group Chat<?php echo $group_id; ?></h1>
    <div>
        <?php foreach ($messages as $msg): ?>
            <div class="chat-box <?php echo ($msg['sender_id'] == $sender_id) ? 'sent' : ''; ?>">
                <strong><?php echo htmlspecialchars($msg['sender_name']) . ', ' . htmlspecialchars($msg['register_or_faculty_id']); ?>:</strong>
                <?php echo htmlspecialchars($msg['message']); ?>
            </div>
        <?php endforeach; ?>
    </div>
    <form method="post">
        <textarea name="message" required></textarea>
        <button type="submit">Send</button>
    </form><br>
    <a href="student_panel.php" class="back-button">Back to Student Panel</a>
</div>
    </section>
</body>
</html>
