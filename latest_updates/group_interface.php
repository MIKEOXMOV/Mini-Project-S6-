<!DOCTYPE html>
<!-- Coding by CodingNepal || www.codingnepalweb.com -->
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- Boxicons CSS -->
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
<title>Side Navigation Bar in HTML CSS JavaScript</title>
<link rel="stylesheet" href="group_interface.css" />
</head>
<body>
<!-- navbar -->
<nav class="navbar">
  <div class="logo_item">
    <i class="bx bx-menu" id="sidebarOpen"></i>
    <img src="logo.png" alt=""></i>OnTrackify
  </div>

  <div class="search_bar">
    <input type="text" placeholder="Search" />
  </div>

  <div class="navbar_content">
    <i class="bi bi-grid"></i>
    <i class='bx bx-sun' id="darkLight"></i>
    <i class='bx bx-bell'></i>
    <img src="logo1.png" alt="" class="profile" />
  </div>
</nav>

<!-- sidebar -->
<nav class="sidebar">
  <div class="menu_content">
    <ul class="menu_items">
      <div class="menu_title menu_dahsboard"></div>
      <!-- duplicate or remove this li tag if you want to add or remove navlink with submenu -->
      <!-- start -->
      <li class="item">
        <div href="#" class="nav_link submenu_item">
          <span class="navlink_icon">
            <i class="bx bx-home-alt"></i>
          </span>
          <span class="navlink">Details</span>
          <i class="bx bx-chevron-right arrow-left"></i>
          <ul class="menu_items submenu">
            <a href="#" class="nav_link sublink">View Group</a>
            <a href="#" class="nav_link sublink">Request Guide</a>
            <a href="calender.html" class="nav_link sublink">Project Calendar</a>
            <a href="#" class="nav_link sublink">Progress</a>
          </ul>
        </div>
      </li>
    </ul>
    <ul class="menu_items">
      <div class="menu_title menu_editor"></div>
      <!-- duplicate these li tag if you want to add or remove navlink only -->
      <!-- Start -->
      <li class="item">
        <a href="#" class="nav_link" data-url="profile_group_display.php">
          <span class="navlink_icon">
            <i class="bx bxs-magic-wand"></i>
          </span>
          <span class="navlink">Group Members</span>
        </a>
      </li>
      <!-- End -->
      <li class="item">
        <a href="#" class="nav_link" data-url="update_page.php">
          <span class="navlink_icon">
            <i class="bx bx-loader-circle"></i>
          </span>
          <span class="navlink">Updates</span>
        </a>
      </li>
      <li class="item">
        <a href="#" class="nav_link" data-url="chat_page.php">
          <span class="navlink_icon">
            <i class="bx bx-filter"></i>
          </span>
          <span class="navlink">Chat</span>
        </a>
      </li>
      <li class="item">
        <a href="#" class="nav_link" data-url="fileupload.php" id="uploadLink">
          <span class="navlink_icon">
            <i class="bx bx-cloud-upload"></i>
          </span>
          <span class="navlink">Upload new</span>
        </a>
      </li>
    </ul>
    <ul class="menu_items">
      <div class="menu_title menu_setting"></div>
      <li class="item">
        <a href="#" class="nav_link">
          <span class="navlink_icon">
            <i class="bx bx-flag"></i>
          </span>
          <span class="navlink">Notice board</span>
        </a>
      </li>
      <li class="item">
        <a href="#" class="nav_link">
          <span class="navlink_icon">
            <i class="bx bx-medal"></i>
          </span>
          <span class="navlink">Marks</span>
        </a>
      </li>
      <li class="item">
        <a href="#" class="nav_link">
          <span class="navlink_icon">
            <i class="bx bx-cog"></i>
          </span>
          <span class="navlink">Analytics</span>
        </a>
      </li>
      <li class="item">
        <a href="#" class="nav_link">
          <span class="navlink_icon">
            <i class="bx bx-layer"></i>
          </span>
          <span class="navlink">Features</span>
        </a>
      </li>
    </ul>
  </div>
</nav>

<!-- Content Container -->
<div id="content"></div>

<!-- JavaScript -->
<script src="script.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  // Get the content container
  const contentContainer = document.getElementById('content');
  
  // Add click event listeners to sidebar links
  const sidebarLinks = document.querySelectorAll('.nav_link');
  sidebarLinks.forEach(link => {
    link.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent default link behavior
      const url = this.getAttribute('data-url'); // Get the URL from data-url attribute
      if (url) {
        fetch(url)
          .then(response => response.text())
          .then(html => {
            contentContainer.innerHTML = html; // Replace content with fetched HTML
          })
          .catch(error => console.error('Error fetching content:', error));
      }
    });
  });
});
</script>

</body>
</html>
