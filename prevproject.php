
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Project Details</title>
    <link rel="stylesheet" href="prevstyle.css">
</head>
<body>
    <div class="container">
        <h2>Enter Project Details</h2>
        <form action="upload.php" method="post">
            <label for="projectName">Project Name:</label>
            <input type="text" id="projectName" name="projectName" required><br>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea><br>

            <label for="groupMembers">Group Members:</label>
            <input type="text" id="groupMembers" name="groupMembers" required><br>

            <label for="contactNumber">Contact Number:</label>
            <input type="text" id="contactNumber" name="contactNumber" required><br>

            <label for="references">References:</label>
            <textarea id="references" name="references" rows="4" required></textarea><br>

            <input type="submit" value="Add">
        </form>
    </div>
</body>
</html>
