<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form id="forgotPasswordForm" action="forgot_password_process.php" method="POST">
            <label for="email">Enter your email:</label>
            <input type="email" id="email" name="email" required>
            <label for="newPassword">Enter new password:</label>
            <input type="password" id="newPassword" name="newPassword" required>
            <button type="submit">Submit</button>
        </form>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
