document.addEventListener("DOMContentLoaded", function() {
    const projectForm = document.getElementById("projectForm");
    const projectTableBody = document.getElementById("projectTableBody");

    // Event listener for form submission
    projectForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission behavior

        // Create FormData object from the form
        const formData = new FormData(projectForm);

        // Send form data to the server using fetch API
        fetch("upload.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Log server response
            // Clear form fields after successful submission
            projectForm.reset();
            // Reload project table to display newly uploaded project
            loadProjects();
        })
        .catch(error => {
            console.error("Error uploading project:", error);
        });
    });

    // Function to load projects and display them in the table
    function loadProjects() {
        // Fetch project details from the server using AJAX
        fetch("display_projects.php")
            .then(response => response.text())
            .then(data => {
                projectTableBody.innerHTML = data;
            })
            .catch(error => {
                console.error("Error fetching projects:", error);
            });
    }

    // Load projects when the page is loaded
    loadProjects();
});


const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})