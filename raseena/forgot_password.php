<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!--<link rel="stylesheet" href="styles.css">-->
</head>

<body>
    <div class="header">
        <h2>Reset Password</h2>
    </div>
    <form id="forgotPasswordForm" action="forgot_password_process.php" method="POST">
    <div class="input-group">
    <label for="dropdown">Select an option:</label>
  <select id="dropdown" name="type">
    <option value="student">Student</option>
    <option value="guide">Guide</option>
    <option value="coordinator">Coordinator</option>
    <!-- Add more options as needed -->
  </select>
  </div>
        <div class="input-group">
            <label>PKD</label>
            <input type="text" name="pkd">
        </div>
        <div class="input-group">
            <label>New Password</label>
            <input type="password" name="newPassword">
        </div>
        <div class="input-group">
            <button type="submit" class="btn">Submit</button>
        </div>
    </form>

    <script src="forgot_password.js"></script>
</body>



</html>