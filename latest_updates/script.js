document.addEventListener("DOMContentLoaded", function() {
    // Add event listeners for sidebar open/close
    const sidebarOpen = document.getElementById('sidebarOpen');
    const sidebarClose = document.querySelector('.collapse_sidebar');
    const sidebar = document.querySelector('.sidebar');

    if (sidebarOpen && sidebarClose && sidebar) {
        sidebarOpen.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        sidebarClose.addEventListener('click', () => {
            sidebar.classList.remove('active');
        });
    } else {
        console.error("One or more sidebar elements not found.");
    }
});
