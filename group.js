document.addEventListener("DOMContentLoaded", function () {
    const studentList = document.getElementById("studentList");
    const group1 = document.getElementById("group1");
    const groupList1 = document.getElementById("groupList1");

    // Fetch students from the database using AJAX
    function fetchStudents() {
        fetch('fetch_students.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(student => {
                    const li = document.createElement("li");
                    li.textContent = student.name;
                    li.draggable = true;
                    li.addEventListener("dragstart", dragStart);
                    studentList.appendChild(li);
                });
            })
            .catch(error => console.error('Error fetching students:', error));
    }

    // Drag and drop event handlers
    function dragStart(event) {
        event.dataTransfer.setData("text/plain", event.target.textContent);
    }

    group1.addEventListener("dragover", dragOver);
    group1.addEventListener("drop", drop);

    function dragOver(event) {
        event.preventDefault();
    }

    function drop(event) {
        event.preventDefault();
        const studentName = event.dataTransfer.getData("text/plain");
        const li = document.createElement("li");
        li.textContent = studentName;
        groupList1.appendChild(li);
    }

    // Fetch students when the page loads
    fetchStudents();
});
