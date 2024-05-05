document.addEventListener('DOMContentLoaded', function () {
    // Function to fetch guides and populate the guide select options
    function fetchGuides() {
        fetch('fetch_guides.php')
        .then(response => response.json())
        .then(data => {
            const guideSelect = document.getElementById('guideSelect');
            // Clear existing options
            guideSelect.innerHTML = '';
            // Add a default option
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Select Guide';
            guideSelect.appendChild(defaultOption);
            // Add guide options
            data.forEach(guide => {
                const option = document.createElement('option');
                option.value = guide.id;
                option.textContent = guide.name;
                guideSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching guides:', error));
    }

    // Fetch guides and populate the guide select options on page load
    fetchGuides();

    // Handle form submission
    const requestForm = document.getElementById('requestForm');
    requestForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(requestForm);
        fetch('submit_request.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(message => {
            alert(message); // Display success or error message
            requestForm.reset(); // Reset the form
            // After submission, fetch guides again to update the select options
            fetchGuides();
        })
        .catch(error => console.error('Error submitting request:', error));
    });
});
