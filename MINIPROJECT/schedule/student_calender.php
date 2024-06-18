<?php
// Include the database connection file
include 'C:\xampp\htdocs\mini\schedule\db-connect.php'; // Adjust the path as needed

// Check if the connection is successful
if ($conn->connect_error) {
    die("Cannot connect to the database: " . $conn->connect_error);
}

// Fetch events from the database
$sql = "SELECT id, title, start_datetime AS start, end_datetime AS end FROM schedule_list";
$result = $conn->query($sql);

$events = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

// Convert the events array to JSON format
$json_events = json_encode($events);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OnTrackify Student Calendar</title>
    
    <!-- Include FullCalendar CSS -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    
    <!-- Style for the calendar -->
    <style>
        html, body {
            height: 100%;
            width: 100%;
            font-family: Apple Chancery, cursive;
            background: linear-gradient(to right, #aed9e0, #e9ecef); /* Gradient background */
        }

        #calendar {
            margin: 20px auto;
            max-width: 900px;
        }

        .fc-toolbar.fc-header-toolbar {
            background-color: #007bff; /* Blue background for the calendar header */
            color: white;
        }

        .fc-toolbar h2 {
            font-size: 1.5em;
            margin: 0;
        }

        .fc-unthemed td.fc-today, .fc-unthemed th.fc-today {
            background-color: rgba(255,255,255,0.1); /* Light background for today's date */
        }
    </style>
</head>
<body>
    <!-- Calendar -->
    <h1 style="text-align: center; margin-top: 20px;">OnTrackify Student Calendar</h1>
    <div id='calendar'></div>

    <!-- Include FullCalendar JS -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script>
        // Initialize FullCalendar
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                // Set options for FullCalendar
                defaultView: 'month',
                editable: false, // Disable editing
                eventLimit: true,
                events: <?php echo $json_events; ?> // Load events from PHP
            });
        });
    </script>

</body>
</html>
