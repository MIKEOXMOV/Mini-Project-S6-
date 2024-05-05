<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previous Projects</title>
    <link rel="stylesheet" href="showstyles.css">
</head>
<body>
    <div class="container">
        <h1>Previous Projects</h1>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Description</th>
                        <th>Group Members</th>
                        <th>Contact Number</th>
                        <th>References</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'display_projects.php'; ?>
                </tbody>
            </table>
        </div>
        <div class="upload-button">
            <a href="prevproject.php" class="btn">Upload New</a>
        </div>
    </div>
</body>
</html>
