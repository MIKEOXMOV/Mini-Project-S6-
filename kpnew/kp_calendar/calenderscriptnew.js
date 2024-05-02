// script.js

// Define an array to store events
let events = [];

// letiables to store event input fields and reminder list
let eventDateInput =
	document.getElementById("eventDate");
let eventTitleInput =
	document.getElementById("eventTitle");
let eventDescriptionInput =
	document.getElementById("eventDescription");
	let reminderList =
	document.getElementById("reminderList");


// Counter to generate unique event IDs
let eventIdCounter = 1;

// Function to add events
function addEvent() {
    let date = document.getElementById("eventDate").value;
    let title = document.getElementById("eventTitle").value;
    let description = document.getElementById("eventDescription").value;

    console.log("Date:", date);
    console.log("Title:", title);
    console.log("Description:", description);

    // Check if all fields are filled
    if (date.trim() !== '' && title.trim() !== '') {
        // Create a new event object
        let event = {
            date: date,
            title: title,
            description: description,
            id: eventIdCounter // Assign a unique ID
        };

        // Increment the event ID counter
        eventIdCounter++;

        // Push the event to the events array
        events.push(event);

        console.log("Event:", event);

        // Send the event data to a PHP script for processing
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/my_php_project/add_event.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Optionally, handle the response from the server
                console.log(xhr.responseText);
                alert("Event added successfully!");
                // Call displayReminders after adding an event
                displayReminders();
            }
        };
        xhr.send(JSON.stringify(event));

        // Optionally, you can clear the input fields after adding the event
        document.getElementById("eventDate").value = '';
        document.getElementById("eventTitle").value = '';
        document.getElementById("eventDescription").value = '';
    } else {
        // Display an error message if any field is empty
        console.log("All fields are required!");
        alert("All fields are required!");
    }
	
}


function editEvent(eventId) {
    // Find the event in the events array
    let event = events.find(event => event.id === eventId);
    if (event) {
        // Populate event details into input fields for editing
        eventDateInput.value = event.date;
        eventTitleInput.value = event.title;
        eventDescriptionInput.value = event.description;

        // Optionally, you can hide the add button and show an update button
        // Update button should trigger a function to update the event
    }
}


// Function to delete an event by ID
// Function to delete an event by ID
// Function to delete an event
// Function to delete an event by ID
function deleteMostRecentEvent() {
    // Check if there are any events to delete
    if (events.length > 0) {
        // Get the most recent event (which is the last item in the events array)
        let mostRecentEvent = events[events.length - 1];

        // Delete the most recent event from the events array
        events.pop();

        // Update the reminder section
        displayReminders();

        // Send a request to delete the event from the database
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/my_php_project/delete_event.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Optionally, handle the response from the server
                    console.log(xhr.responseText);
                    alert("Most recent event deleted successfully!");
                } else {
                    console.error("Error:", xhr.status);
                    alert("Error deleting most recent event. Please try again.");
                }
            }
        };
        xhr.send(JSON.stringify({
            date: mostRecentEvent.date,
            title: mostRecentEvent.title,
            description: mostRecentEvent.description
        }));
    } else {
        console.log("No events to delete.");
        // Optionally, you can display a message indicating that there are no events to delete
    }
}

// Function to display reminders
function displayReminders() {
    let reminderList = document.getElementById("reminderList");
    reminderList.innerHTML = ""; // Clear the reminder list before updating

    // Iterate over all events
    events.forEach(function (event) {
        let eventDate = new Date(event.date);
        let listItem = document.createElement("li");
        listItem.innerHTML = `<strong>${event.title}</strong> - ${event.description} on ${eventDate.toLocaleDateString()}`;

        // Create a delete button for each reminder item
        let deleteButton = document.createElement("button");
        deleteButton.className = "delete-event";
        deleteButton.textContent = "Delete";
        deleteButton.onclick = function () {
            deleteMostRecentEvent();
        };
        listItem.appendChild(deleteButton);

        // Add the reminder item to the reminder list
        reminderList.appendChild(listItem);
    });
}

// Function to generate a range of 
// years for the year select input
function generate_year_range(start, end) {
	let years = "";
	for (let year = start; year <= end; year++) {
		years += "<option value='" +
			year + "'>" + year + "</option>";
	}
	return years;
}

// Initialize date-related letiables
today = new Date();
currentMonth = today.getMonth();
currentYear = today.getFullYear();
selectYear = document.getElementById("year");
selectMonth = document.getElementById("month");

createYear = generate_year_range(1970, 2050);

document.getElementById("year").innerHTML = createYear;

let calendar = document.getElementById("calendar");

let months = [
	"January",
	"February",
	"March",
	"April",
	"May",
	"June",
	"July",
	"August",
	"September",
	"October",
	"November",
	"December"
];
let days = [
	"Sun", "Mon", "Tue", "Wed",
	"Thu", "Fri", "Sat"];

$dataHead = "<tr>";
for (dhead in days) {
	$dataHead += "<th data-days='" +
		days[dhead] + "'>" +
		days[dhead] + "</th>";
}
$dataHead += "</tr>";

document.getElementById("thead-month").innerHTML = $dataHead;

monthAndYear =
	document.getElementById("monthAndYear");
showCalendar(currentMonth, currentYear);

// Function to navigate to the next month
function next() {
	currentYear = currentMonth === 11 ?
		currentYear + 1 : currentYear;
	currentMonth = (currentMonth + 1) % 12;
	showCalendar(currentMonth, currentYear);
}

// Function to navigate to the previous month
function previous() {
	currentYear = currentMonth === 0 ?
		currentYear - 1 : currentYear;
	currentMonth = currentMonth === 0 ?
		11 : currentMonth - 1;
	showCalendar(currentMonth, currentYear);
}

// Function to jump to a specific month and year
function jump() {
	currentYear = parseInt(selectYear.value);
	currentMonth = parseInt(selectMonth.value);
	showCalendar(currentMonth, currentYear);
}

// Function to display the calendar
function showCalendar(month, year) {
	let firstDay = new Date(year, month, 1).getDay();
	tbl = document.getElementById("calendar-body");
	tbl.innerHTML = "";
	monthAndYear.innerHTML = months[month] + " " + year;
	selectYear.value = year;
	selectMonth.value = month;

	let date = 1;
	for (let i = 0; i < 6; i++) {
		let row = document.createElement("tr");
		for (let j = 0; j < 7; j++) {
			if (i === 0 && j < firstDay) {
				cell = document.createElement("td");
				cellText = document.createTextNode("");
				cell.appendChild(cellText);
				row.appendChild(cell);
			} else if (date > daysInMonth(month, year)) {
				break;
			} else {
				cell = document.createElement("td");
				cell.setAttribute("data-date", date);
				cell.setAttribute("data-month", month + 1);
				cell.setAttribute("data-year", year);
				cell.setAttribute("data-month_name", months[month]);
				cell.className = "date-picker";
				cell.innerHTML = "<span>" + date + "</span";

				if (
					date === today.getDate() &&
					year === today.getFullYear() &&
					month === today.getMonth()
				) {
					cell.className = "date-picker selected";
				}

				// Check if there are events on this date
				if (hasEventOnDate(date, month, year)) {
					cell.classList.add("event-marker");
					cell.appendChild(
						createEventTooltip(date, month, year)
				);
				}

				row.appendChild(cell);
				date++;
			}
		}
		tbl.appendChild(row);
	}

	displayReminders();
}

// Function to create an event tooltip
function createEventTooltip(date, month, year) {
	let tooltip = document.createElement("div");
	tooltip.className = "event-tooltip";
	let eventsOnDate = getEventsOnDate(date, month, year);
	for (let i = 0; i < eventsOnDate.length; i++) {
		let event = eventsOnDate[i];
		let eventDate = new Date(event.date);
		let eventText = `<strong>${event.title}</strong> - 
			${event.description} on 
			${eventDate.toLocaleDateString()}`;
		let eventElement = document.createElement("p");
		eventElement.innerHTML = eventText;
		tooltip.appendChild(eventElement);
	}
	return tooltip;
}

// Function to get events on a specific date
function getEventsOnDate(date, month, year) {
	return events.filter(function (event) {
		let eventDate = new Date(event.date);
		return (
			eventDate.getDate() === date &&
			eventDate.getMonth() === month &&
			eventDate.getFullYear() === year
		);
	});
}

// Function to check if there are events on a specific date
function hasEventOnDate(date, month, year) {
	return getEventsOnDate(date, month, year).length > 0;
}

// Function to get the number of days in a month
function daysInMonth(iMonth, iYear) {
	return 32 - new Date(iYear, iMonth, 32).getDate();
}

// Call the showCalendar function initially to display the calendar
showCalendar(currentMonth, currentYear);