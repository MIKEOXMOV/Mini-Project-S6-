// profile.js

document.addEventListener("DOMContentLoaded", function() {
    // Fetch group members' information
    fetchGroupMembers();
});

function fetchGroupMembers() {
    // Make an AJAX request to fetch group members' information
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "profile_group_display.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Parse the JSON response
            var groupMembers = JSON.parse(xhr.responseText);
            // Update the profile section with the retrieved data
            updateProfile(groupMembers);
        }
    };
    xhr.send();
}

function updateProfile(groupMembers) {
    // Select the profile container
    var profileContainer = document.querySelector(".profile-container");
    // Create a list to display group members
    var ul = document.createElement("ul");
    // Iterate over group members and create list items
    groupMembers.forEach(function(member) {
        var li = document.createElement("li");
        li.textContent = member.name; // Assuming member has a 'name' property
        ul.appendChild(li);
    });
    // Clear previous content and append the updated list
    profileContainer.innerHTML = "";
    profileContainer.appendChild(ul);
}
