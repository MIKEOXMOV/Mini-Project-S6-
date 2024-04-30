
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
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
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
                <li><a href="#">
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
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1" id="profile-box">
                        <i class="uil uil-suitcase-alt"></i>
                        <span class="text">Profile</span>
                </div>
                
                <!-- End of Profile Details Section -->
                    <div class="box box2">
                        <i class="uil uil-server-alt"></i>
                        <span class="text">Phase</span>
                        <span class="number">2</span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-users-alt"></i>
                        <span class="text">Group Members</span>
                        <span class="number">4</span>
                    </div>
                </div>
            </div>

           












            

            <div id="notification-content">
                <!-- Add Join Group Button here -->
</div>
           


            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Activity</span>
                </div>
<!-- Profile Details Section -->
<div class="profile-details" id="profile-details" style="display: none;">
                </div>

                <!-- Profile Details Section -->
                <div class="profile-details" >
                    <h2>Profile Details</h2>
                    <p><strong>Name:</strong> <?php echo $student['name']; ?></p>
                    <p><strong>Register Number:</strong> <?php echo $student['registerNo']; ?></p>
                    <p><strong>Semester:</strong> <?php echo $student['sem']; ?></p>
                    <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
               

    </section>

    <script src="stdscript.js"></script>

    <script>
        let options = {
          startAngle: -1.55,
          size: 150,
          value: 0.85,
          fill: {gradient: ['#a445b2', '#fa4299']}
        }
        $(".circle .bar").circleProgress(options).on('circle-animation-progress',
        function(event, progress, stepValue){
          $(this).parent().find("span").text(String(stepValue.toFixed(2).substr(2)) + "%");
        });
        $(".js .bar").circleProgress({
          value: 0.70
        });
        $(".react .bar").circleProgress({
          value: 0.60
        });
      </script>
       </div>
       
      <script>
$(document).ready(function() {
    // Function to handle click event on the "Notifications" link
    $('#notification-link').on('click', function(event) {
        event.preventDefault();
        // Fetch and display notification content
        fetchNotificationContent();
    });

    // Function to fetch notification content via AJAX
    function fetchNotificationContent() {
        $.ajax({
            url: 'fetch_notification_content.php',
            method: 'GET',
            // Optionally, you can pass any additional data here
            success: function(response) {
                // Display notification content in a modal or within the page
                $('#notification-content').html(response);
                // Show the notification content
                $('#notification-content').show();
                // Add the "Join Group" button dynamically
                $('#notification-content').append('<form action="join_group.php" method="POST"><button type="submit" name="join_group" style="background-color: blue; color: white;">Join Group</button></form>');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching notification content:', error);
            }
        });
    }

    // Function to handle click event on notification content to hide it
    $(document).on('click', '#notification-content', function(event) {
        // Hide the notification content when clicked
        $(this).hide();
    });
});
</script>


</script>



</body>
</html>