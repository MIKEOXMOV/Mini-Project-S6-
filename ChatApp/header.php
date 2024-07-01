<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatApp</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
