<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['name'])) {
    header('location: login.php');
}

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'project1');

// Get the logged-in user's details
$name = $_SESSION['name'];
$query = "SELECT * FROM student WHERE name='$name'";
$result = mysqli_query($db, $query);
$student = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="stdstyle.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>

    <title>Admin Dashboard Panel</title>
    <style>
        /* General styles for the profile section */
        .profile-details {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #cfe2ff;
            border-radius: 8px;
            background-color: #e7f3ff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            color: #333;
        }

        .profile-details h2 {
            text-align: center;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .profile-details p {
            margin: 10px 0;
            font-size: 16px;
        }

        .profile-details p strong {
            color: #555;
        }

        /* Join Group Button styles */
        #notification-content {
            text-align: center;
            margin: 20px auto;
        }

        #notification-content button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        #notification-content button:hover {
            background-color: #0056b3;
        }

        /* Edit Button styles */
        .edit-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #5bc0de;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .edit-button:hover {
            background-color: #31b0d5;
        }

        /* Form Styles */
        .join-group-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .join-group-form input {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 80%;
        }

        .join-group-form button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .join-group-form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="logo.png" alt="">
            </div>
            <span class="logo_name">OnTrackify</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="#" id="profile-link">
                    <i class="uil uil-user-square"></i>
                    <span class="link-name">Profile</span>
                </a></li>
                <li><a href="#" id="guide-link">
                    <i class="uil uil-user-square"></i>
                    <span class="link-name">Guide</span>
                </a></li>
                <li><a href="#" id="notification-link">
                   <i class="uil uil-chart"></i>
                     <span class="link-name">Notifications</span>
                       </a></li>
                <li><a href="#">
                    <i class="uil uil-calendar-alt"></i>
                    <span class="link-name">Project Calendar</span>
                </a></li>
                <li><a href="http://localhost/my_php_project/showprevtable.php">
                    <i class="uil uil-angle-double-up"></i>
                    <span class="link-name">Previous Projects</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-trophy"></i>
                    <span class="link-name">Marks</span>
                </a></li>
            </ul>
            <li><a href="http://localhost/my_php_project/fileupload.php">
                    <i class="uil uil-trophy"></i>
                    <span class="link-name">Upload</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="#">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
            
            <img src="images/profile.jpg" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                   <!-- <i class="uil uil-tachometer-fast-alt"></i>-->
                    <span class="text"></span>
                </div>
            </div>

            <div id="notification-content">
                <!-- Join Group Form -->
                <div class="join-group-form">
                    <h2>Join a Group</h2>
                    <form id="joinGroupForm">
                        <input type="text" id="group_id" name="group_id" placeholder="Enter Group ID" required>
                        <button type="submit">Join Group</button>
                    </form>
                    <div id="responseMessage"></div>
                </div>
            </div>

            <!-- Profile Details Section -->
            <div class="profile-details" id="profile-details" style="display: none;">
                <button class="edit-button" onclick="toggleEditForm()">Edit</button>
                <h2>Profile Details</h2>
                <p><strong>Name:</strong> <?php echo $student['name']; ?></p>
                <p><strong>Register Number:</strong> <?php echo $student['registerNo']; ?></p>
                <p><strong>Semester:</strong> <?php echo $student['sem']; ?></p>
                <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
            </div>
        </div>
    </section>

    <script src="stdscript.js"></script>

    <script>
        $(document).ready(function() {
            $('#profile-link').on('click', function(event) {
                event.preventDefault();
                $('#profile-details').toggle();
            });

            // Handle form submission
            $('#joinGroupForm').on('submit', function(event) {
                event.preventDefault();
                var groupId = $('#group_id').val();

                $.ajax({
                    url: 'join_group_try.php',
                    method: 'POST',
                    data: { group_id: groupId },
                    success: function(response) {
                        $('#responseMessage').text(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error joining group:', error);
                        $('#responseMessage').text('Error joining group.');
                    }
                });
            });
        });
    </script>
</body>
</html>
