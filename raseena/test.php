<!-- <?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST['studentId'];
    $guideId = $_POST['guideId'];
    echo "studentId - ". $studentId . "guideId - ". $guideId;
    //getting studentId value 12 and guideId value fac3
    // Insert the request into the database
    $sql = "INSERT INTO requests (student_id, guide_id) VALUES ($studentId, $guideId)";
    echo "sql query: ". $sql;
    //getting query INSERT INTO requests (student_id, guide_id) VALUES (12, fac3)
    if ($conn->query($sql) === TRUE) {
        echo "Request submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?> -->