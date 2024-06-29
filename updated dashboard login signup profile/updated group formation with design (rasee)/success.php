<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="stdstyle.css">
    <style>
        /* Add your custom styles here */
        body {
            background-color: #ffffff; /* White background */
            font-family: Arial, sans-serif;
            line-height: 1.6;
            text-align: center;
            margin: 0; /* Remove default margin */
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            margin-left: 5px; /* Adjust margin as needed */
        }
        .logo img {
            width: 50px; /* Adjust size as needed */
            height: auto;
            margin-right: 10px;
        }
        .logo span {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .success-message {
            margin-top: 50px;
            background-color: #d4edda; /* Bootstrap success color */
            color: #155724; /* Bootstrap success text color */
            border: 1px solid #c3e6cb; /* Bootstrap success border color */
            padding: 15px;
            border-radius: 5px;
        }
        .back-to-dashboard {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff; /* Bootstrap primary button color */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-to-dashboard:hover {
            background-color: #0056b3; /* Darker shade of primary color on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="logo.png" alt="Logo">
            <span>OnTrackify</span>
        </div>
        <h3>Groups Successfully Finalized</h3>
        <div class="success-message">
            <p>Your groups have been successfully finalized.</p>
        </div>
        <a href="coordinator_panel.php" class="back-to-dashboard">Back to Dashboard</a>
    </div>
</body>
</html>
