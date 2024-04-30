<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Monitoring</title>
    <style>
        /* CSS styles */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .group-formation button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .group-formation button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Project Monitoring</h1>
        <h2>Student List</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="studentList">
                <?php
                // PHP code to fetch student details from the server
                $servername = "localhost";
                $username = "root";
                $password = ""; // Your MySQL password
                $dbname = "project1"; // Your database name

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Retrieve student details from the database
                $sql = "SELECT registerNo, name FROM student";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["registerNo"] . "</td>";
                        echo "<td><input type='checkbox' name='selectedStudents[]' value='" . $row["registerNo"] . "'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>0 results</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
        <div class="group-formation" style="margin-top: 20px;">
            <h2>Form Group</h2>
            <button id="formGroupBtn" onclick="formGroup()" disabled>Form Group</button>
        </div>
    </div>
    
    <script>
        //Function to disable checkboxes for selected students
        function disableSelectedCheckboxes(selectedStudents) {
            var checkboxes = document.querySelectorAll('input[name="selectedStudents[]"]');
            checkboxes.forEach(function(checkbox) {
                if (selectedStudents.includes(checkbox.value)) {
                    checkbox.disabled = true;
                }
            });
        }

        //Function to check if at least one checkbox is checked
        function checkIfAnyCheckboxChecked() {
            var checkboxes = document.querySelectorAll('input[name="selectedStudents[]"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    return true; // At least one checkbox is checked
                }
            }
            return false; // No checkboxes are checked
        }

        // Function to enable/disable the "Form Group" button based on checkbox status
        function enableDisableFormGroupButton() {
            console.log("enableDisableFormGroupButton() function called");
            var formGroupBtn = document.getElementById("formGroupBtn");
            if (checkIfAnyCheckboxChecked()) {
                formGroupBtn.disabled = false; // Enable the button
            } else {
                formGroupBtn.disabled = true; // Disable the button
            }
        }

        // Function to form a group
        function formGroup() {
            // Retrieve the selected student IDs and perform further processing
            var selectedStudents = [];
            var checkboxes = document.querySelectorAll('input[name="selectedStudents[]"]:checked');
            checkboxes.forEach(function(checkbox) {
                selectedStudents.push(checkbox.value);
            });
            console.log(selectedStudents);
            var groupSize = selectedStudents.length;

            // AJAX request to store group information in the database
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4) {
                    console.log("Response:", this.responseText); // Log the response
                    if (this.status == 200) {
                        try {
                            // Parse the JSON response
                            var response = JSON.parse(this.responseText);
                            if (response.success) {
                                // Success message
                                alert(response.message);
                                
                                // Call the function to disable checkboxes for selected students
                                disableSelectedCheckboxes(selectedStudents);
                            } else {
                                // Error message
                                alert("Error: " + response.message);
                            }
                        } catch (e) {
                            // Error parsing JSON
                            console.error("Error parsing JSON:", e);
                            alert("Error: Invalid JSON response");
                        }
                    } else {
                        // HTTP error
                        console.error("HTTP error:", this.status, this.statusText);
                        alert("Error: HTTP " + this.status);
                    }
                }
            };
            xhr.open("POST", "process_group.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("student_ids=" + JSON.stringify(selectedStudents));
        }

        // Add event listener to checkboxes to enable/disable the button
        var checkboxes = document.querySelectorAll('input[name="selectedStudents[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', enableDisableFormGroupButton);
        });
    </script>
</body>
</html>

