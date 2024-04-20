<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Groups</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Student Groups</h1>
    <form id="groupForm" action="group_students.php" method="GET">
        <label for="groupSize">Enter group size:</label>
        <input type="number" id="groupSize" name="groupSize" min="1" required>
        <button type="submit">Group Students</button>
    </form>
    <div id="groupContainer"></div>
    <script src="script.js"></script>
</body>
</html>
