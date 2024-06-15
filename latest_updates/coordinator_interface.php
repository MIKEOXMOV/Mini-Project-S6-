<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinator Interface</title>
    <link rel="stylesheet" href="requeststyles.css">
</head>
<body>
    <div class="container">
        <h2>Grouped Students</h2>
        <div id="groupedStudents">
            <?php include 'retrieve_grouped_students.php'; ?>
        </div>
    </div>

     <!-- Place the script block here -->
     <script>
        function sendJoinRequest(groupId, studentId) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Handle response from the server
                    alert(this.responseText);
                }
            };
            xhr.open("POST", "handle_request_join.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("group_id=" + groupId + "&student_id=" + studentId);
        }
    </script>
    </script>
</body>
</html>
