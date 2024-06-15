// Function to fetch student details from the server
function fetchStudents() {
    // Replace the URL with the actual endpoint to fetch students
    fetch("get_students.php")
    .then(response => response.json())
    .then(data => {
        const studentList = document.getElementById("studentList");
        // Clear previous student list
        studentList.innerHTML = "";

        // Loop through each student and display details
        data.forEach(student => {
            const studentDiv = document.createElement("div");
            studentDiv.classList.add("student");
            studentDiv.innerHTML = `
                <p>Name: ${student.name}</p>
                <p>ID: ${student.id}</p>
                <button onclick="addToGroup(${student.id})">Add to Group</button>
            `;
            studentList.appendChild(studentDiv);
        });
    })
    .catch(error => {
        console.error("Error fetching students:", error);
    });
}

// Function to add a student to the group
function addToGroup(studentId) {
    // You can implement your logic here to add the student to the group
    console.log("Student ID:", studentId);
}

// Function to form groups
function formGroups() {
    // You can implement your logic here to form groups
    alert("Groups formed successfully!");
}

// Fetch students when the page loads
fetchStudents();
