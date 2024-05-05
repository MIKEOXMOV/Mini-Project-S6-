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
                <li><a href="#">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Analytics</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-calendar-alt"></i>
                    <span class="link-name">Project Calendar</span>
                </a></li>
                <li><a href="showprevtable.php">
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

               
                </div>
            </div>

           
                 
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

</body>
</html>