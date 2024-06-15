<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OnTrackify Login</title>
</head>
<body>
    <h1>Welcome to OnTrackify</h1>
    <form action="login.php" method="POST">
        <label for="role">Select your role:</label>
        <select name="role" id="role">
            <option value="coordinator">Coordinator</option>
            <option value="guide">Guide</option>
            <option value="student">Student</option>
        </select>
        <br><br>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>