<?php
// Maximum file size allowed (in bytes)
$maxFileSize = 20 * 1024 * 1024; // 20 MB

// Allowed file types
$allowedFileTypes = array(".pdf", ".doc", ".docx", ".txt", ".ppt", ".pptx");

// Database connection
$conn = new mysqli("localhost", "root", "", "project1");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $filename = $_FILES["file"]["name"];
    $fileType = pathinfo($filename, PATHINFO_EXTENSION);
    $fileSize = $_FILES["file"]["size"]; // Corrected line to get file size
    echo "Uploaded Files Array: ";
    print_r($_FILES);
    echo "<br>";
    
    // Check if file is uploaded
    if (!isset($_FILES['file'])) {
        echo "No file uploaded.";
        exit;
    }
    

echo $fileType ;
    echo "Uploaded File Type: " . $fileType . "<br>";
echo "Allowed File Types: ";
print_r($allowedFileTypes);
echo "<br>";

    echo "Allowed file types array: ";
print_r($allowedFileTypes);


    // Check file size
    if ($fileSize > $maxFileSize) {
        echo "Sorry, your file is too large. Maximum size allowed is 20 MB.";
        exit;
    }
    
    
    $allowedFileTypes = array_map('strtolower', $allowedFileTypes); // Convert allowed types to lowercase
$fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); // Convert uploaded file extension to lowercase
    
    // Check file type
    if (!in_array(strtolower($fileType), $allowedFileTypes)) {
        echo "Sorry, only PDF, DOC, DOCX, TXT, PPT, and PPTX files are allowed.";
        exit;
    }


    
    // Move uploaded file to server
    $targetDir =  "C:/xampp/tmp/";
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        // Insert file details into database
        $sql = "INSERT INTO files (filename, email, filetype) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $filename, $email, $fileType);
        $stmt->execute();
        $stmt->close();
        echo "File uploaded successfully.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
