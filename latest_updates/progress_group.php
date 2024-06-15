<?php
// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'project1');

// Fetch Group ID and members from student_groups and student tables
$query = "SELECT sg.group_id, s.name AS member_name FROM student_groups sg JOIN student s ON sg.student_id = s.registerNo";
$result = mysqli_query($db, $query);

// Check if the query executed successfully
if ($result) {
    // Fetch column names from the database (example: if you have a columns table)
    $columnQuery = "SELECT column_name FROM columns_table";
    $columnResult = mysqli_query($db, $columnQuery);
    $columns = [];
    while ($row = mysqli_fetch_assoc($columnResult)) {
        $columns[] = $row['column_name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Details</title>
    <!-- Add your CSS styles here -->
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Group ID</th>
                <th>Members</th>
                <?php foreach ($columns as $column) : ?>
                    <th><?php echo $column; ?></th>
                <?php endforeach; ?>
                <th>Progress</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result) : ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $row['group_id']; ?></td>
                <td><?php echo $row['member_name']; ?></td>
                <?php foreach ($columns as $column) : ?>
                    <td>
                        <!-- Input fields for dynamic columns -->
                        <input type="text" name="<?php echo $column; ?>" placeholder="<?php echo $column; ?>">
                    </td>
                <?php endforeach; ?>
                <td>
                    <div class="progress-bar">
                        <div class="progress-bar-inner" style="width: 50%;">50%</div>
                    </div>
                </td>
                <td>
                    <button class="btn">Approve</button>
                    <button class="btn">Reject</button>
                </td>
            </tr>
            <?php endwhile; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Button to add new column dynamically -->
    <button id="addColumnBtn">Add Column</button>

    <script>
        document.getElementById("addColumnBtn").addEventListener("click", function() {
            var columnName = prompt("Enter the column name:");
            if (columnName) {
                // Add column header
                var headerRow = document.querySelector("thead tr");
                var newHeader = document.createElement("th");
                newHeader.textContent = columnName;
                headerRow.appendChild(newHeader);
                
                // Add input fields for new column
                var tableRows = document.querySelectorAll("tbody tr");
                tableRows.forEach(function(row) {
                    var newCell = document.createElement("td");
                    var newInput = document.createElement("input");
                    newInput.type = "text";
                    newInput.name = columnName;
                    newInput.placeholder = columnName;
                    newCell.appendChild(newInput);
                    row.appendChild(newCell);
                });
            }
        });
    </script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($db);
?>
