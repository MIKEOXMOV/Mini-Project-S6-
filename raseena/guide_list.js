// script.js
document.addEventListener('DOMContentLoaded', function() {
    // Fetch guides from backend
    fetch('get_guides.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('guide-list').innerHTML = data;
        })
        .catch(error => {
            console.error('Error fetching guides:', error);
        });

    // Add event listener for request buttons
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('request-btn')) {
            const guideId = event.target.dataset.guideId;
            // Handle the request here, for example, send a request to the server
            console.log('Request button clicked for guide with ID:', guideId);
        }
    });
});
