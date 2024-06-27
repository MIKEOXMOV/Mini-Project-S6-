
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard Panel</title>

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="stdstyle.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- jQuery Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- jQuery Circle Progress Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>

    <!-- Custom Styles -->
    <style>
        /* Add your custom styles here */
        .boxes {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 20px;
        }

        .box {
            cursor: pointer;
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .box:hover {
            background-color: #f0f0f0;
        }

        .form-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .form-container {
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
            max-width: 90%;
            text-align: center;
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
            text-align: left;
        }

        .form-container input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button.cancel-btn {
            background-color: #f44336;
            margin-left: 10px;
        }

        .item-list {
            margin-top: 20px;
            text-align: left;
        }

        .item {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="logo.png" alt="Logo">
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
                <li><a href="calendar.html">
                    <i class="uil uil-calendar-alt"></i>
                    <span class="link-name">Project Calendar</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-angle-double-up"></i>
                    <span class="link-name">Previous Projects</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-trophy"></i>
                    <span class="link-name">Marks</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="logout.php">
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
            <img src="images/profile.jpg" alt="Profile Picture">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1" id="projectsBox">
                        <i class="uil uil-suitcase-alt"></i>
                        <span class="text">Projects</span>
                        <span class="number">0</span>
                    </div>
                    <div class="box box2" id="profilesBox">
                        <i class="uil uil-user"></i>
                        <span class="text">Profiles</span>
                        <span class="number">0</span>
                    </div>
                </div>

                <div class="form-overlay" id="formOverlay">
                    <div class="form-container" id="formContainer">
                        <h2>Add/Edit Project</h2>
                        <form id="projectForm" action="add_project.php" method="post">
                            <label for="id">Project ID (for edit/delete):</label>
                            <input type="text" id="id" name="id"><br><br>
                            <label for="courseCode">Course Code:</label>
                            <input type="text" id="courseCode" name="courseCode" required><br><br>
                            <label for="courseName">Course Name:</label>
                            <input type="text" id="courseName" name="courseName" required><br><br>
                            <label for="coordinatorName">Coordinator Name:</label>
                            <input type="text" id="coordinatorName" name="coordinatorName" required><br><br>
                            <label for="batch">Batch:</label>
                            <input type="text" id="batch" name="batch" required><br><br>
                            <label for="semester">Semester:</label>
                            <input type="text" id="semester" name="semester" required><br><br>
                            <button type="submit" name="submit">Submit</button>
                            <button type="submit" name="edit">Edit</button>
                            <button type="submit" name="delete">Delete</button>
                            <button type="button" class="cancel-btn" id="cancelBtn">Cancel</button>
                        </form>
                    </div>
                </div>

                <div class="item-list" id="itemList">
                    <!-- Item list will be dynamically populated -->
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Activity</span>
                </div>

                <div class="activity-data">
                    <!-- Activity data will be displayed here -->
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var projectsBox = document.getElementById("projectsBox");
            var profilesBox = document.getElementById("profilesBox");
            var formOverlay = document.getElementById("formOverlay");
            var formContainer = document.getElementById("formContainer");
            var itemList = document.getElementById("itemList");
            var projectForm = document.getElementById("projectForm");
            var cancelBtn = document.getElementById("cancelBtn");

            // Function to display items based on type
            function displayItems(type) {
                // Fetch and display items from the server
                fetch(`get_items.php?type=${type}`)
                    .then(response => response.json())
                    .then(items => {
                        var list = document.createElement("div");
                        list.classList.add("item-list");

                        items.forEach(function(item) {
                            var itemElement = document.createElement("div");
                            itemElement.classList.add("item");
                            itemElement.dataset.id = item.id; // Store id for update/delete actions
                            itemElement.innerHTML = `
                                <div>Course Code: ${item.courseCode}</div>
                                <div>Course Name: ${item.courseName}</div>
                                <div>Coordinator Name: ${item.coordinatorName}</div>
                                <div>Batch: ${item.batch}</div>
                                <div>Semester: ${item.semester}</div>
                                <div>
                                    <button class="edit-btn">Edit</button>
                                    <button class="delete-btn">Delete</button>
                                </div>
                            `;
                            list.appendChild(itemElement);
                        });

                        itemList.innerHTML = ""; // Clear existing list
                        itemList.appendChild(list); // Append new list
                        itemList.style.display = "block"; // Show item list
                    });
            }

            // Click event on Projects box
            projectsBox.addEventListener("click", function() {
                formOverlay.style.display = "flex"; // Display form overlay
                displayItems("projects"); // Display existing projects
            });

            // Click event on Profiles box
            profilesBox.addEventListener("click", function() {
                formOverlay.style.display = "flex"; // Display form overlay
                displayItems("profiles"); // Display existing profiles
            });

            // Click event on Cancel button
            cancelBtn.addEventListener("click", function() {
                formOverlay.style.display = "none"; // Hide form overlay
                projectForm.reset(); // Reset form
            });

            // Edit and Delete buttons event delegation
            itemList.addEventListener("click", function(event) {
                handleItemAction(event);
            });

            function handleItemAction(event) {
                if (event.target.classList.contains("edit-btn")) {
                    var itemId = event.target.closest(".item").dataset.id;

                    // Fetch item data from the server
                    fetch(`get_item.php?id=${itemId}`)
                        .then(response => response.json())
                        .then(item => {
                            // Pre-fill form with item data for editing
                            projectForm.elements["id"].value = item.id;
                            projectForm.elements["courseCode"].value = item.courseCode;
                            projectForm.elements["courseName"].value = item.courseName;
                            projectForm.elements["coordinatorName"].value = item.coordinatorName;
                            projectForm.elements["batch"].value = item.batch;
                            projectForm.elements["semester"].value = item.semester;

                            // Show form overlay for editing
                            formOverlay.style.display = "flex";
                        });
                } else if (event.target.classList.contains("delete-btn")) {
                    var itemId = event.target.closest(".item").dataset.id;

                    // Send delete request to the server
                    fetch(`delete_item.php?id=${itemId}`, { method: 'DELETE' })
                        .then(response => response.json())
                        .then(result => {
                            if (result.success) {
                                // Refresh item list after deletion
                                displayItems("projects");
                            }
                        });
                }
            }
        });
    </script>
</body>
</html>
