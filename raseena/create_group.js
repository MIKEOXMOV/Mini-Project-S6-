document.addEventListener('DOMContentLoaded', function() {
    const groupsContainer = document.getElementById('groups');
    const studentsContainer = document.getElementById('students');

    // Fetch students from database
    fetch('studentsgroup.php')
        .then(response => response.json())
        .then(data => {
            // Display students
            data.forEach(student => {
                const studentElement = document.createElement('div');
                studentElement.classList.add('student');
                studentElement.draggable = true;
                studentElement.textContent = student.name;
                studentElement.dataset.studentId = student.id;
                studentsContainer.appendChild(studentElement);
            });

            // Calculate number of groups needed
            const numStudents = data.length;
            const numGroups = Math.ceil(numStudents / 4);

            // Display group boxes
            for (let i = 1; i <= numGroups; i++) {
                const groupElement = document.createElement('div');
                groupElement.classList.add('group');
                groupElement.textContent = 'Group ' + i;
                groupsContainer.appendChild(groupElement);
            }
        })
        .catch(error => {
            console.error('Error fetching students:', error);
        });

    // Drag and drop functionality
    let draggedStudent = null;

    studentsContainer.addEventListener('dragstart', function(event) {
        draggedStudent = event.target;
    });

    groupsContainer.addEventListener('dragover', function(event) {
        event.preventDefault();
    });

    groupsContainer.addEventListener('drop', function(event) {
        event.preventDefault();
        if (event.target.classList.contains('group')) {
            event.target.appendChild(draggedStudent);
        }
    });

    // Submit groups
    document.getElementById('submitGroups').addEventListener('click', function() {
        const groupsData = {};

        // Gather group information
        groupsContainer.querySelectorAll('.group').forEach(group => {
            const groupName = group.textContent;
            const groupMembers = Array.from(group.children).map(member => member.dataset.studentId);
            groupsData[groupName] = groupMembers;
        });

        // Send groups data to the server
        fetch('create_group.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ groups: groupsData })
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Output response from server
            alert('Groups submitted successfully.');
        })
        .catch(error => {
            console.error('Error submitting groups:', error);
            alert('Error submitting groups. Please try again.');
        });
    });
});
