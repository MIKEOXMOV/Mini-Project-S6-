<?php
include 'db_connect.php';

$guideId = $_GET['guideId'];

$sql = "SELECT * FROM requests WHERE guide_id = $guideId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $requests = array();
    while($row = $result->fetch_assoc()) {
        $requests[] = $row;
    }
    echo json_encode($requests);
} else {
    echo "0 results";
}

$conn->close();
?>
