document.getElementById("groupForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission from refreshing the page
    
    const formData = new FormData(this); // Get form data
    
    fetch("group_students.php?" + new URLSearchParams(formData)) // Send GET request with form data
        .then(response => response.text()) // Parse response as text
        .then(data => {
            document.getElementById("groupContainer").innerHTML = data; // Display grouped students
        })
        .catch(error => console.error("Error:", error));
});
