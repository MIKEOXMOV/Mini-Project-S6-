function updateRequestStatus(requestId, status) {
    // Make an AJAX request to update request status
    fetch('update_request_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            requestId,
            status
        })
    })
    .then(response => {
        if (response.ok) {
            // Refresh notifications after update
            fetchNotifications();
        } else {
            console.error('Failed to update request status.');
        }
    })
    .catch(error => console.error('Error updating request status:', error));
}


function approveRequest(requestId) {
    updateRequestStatus(requestId, 'approved');
}

function rejectRequest(requestId) {
    updateRequestStatus(requestId, 'rejected');
}

function displayNotifications(notifications) {
    const notificationsContainer = document.getElementById('notifications');
    notificationsContainer.innerHTML = ''; // Clear previous notifications

    notifications.forEach(notification => {
        const notificationElement = document.createElement('div');
        notificationElement.classList.add('notification');
        notificationElement.innerHTML = `
            <p>${notification.requester} has sent you a request.</p>
            <button onclick="approveRequest(${notification.id})">Approve</button>
            <button onclick="rejectRequest(${notification.id})">Reject</button>
        `;
        notificationsContainer.appendChild(notificationElement);
    });
}


function fetchNotifications() {
    // Make an AJAX request to fetch notifications
    fetch('fetch_notifications.php')
        .then(response => response.json())
        .then(data => {
            displayNotifications(data);
        })
        .catch(error => console.error('Error fetching notifications:', error));
}

document.addEventListener("DOMContentLoaded", function() {
    
    // Fetch notifications from the server
    fetchNotifications();

    

    

 
});
