document.addEventListener("DOMContentLoaded", function() {
    updateProgressBar();

    document.getElementById("activity-form").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission

        // Check which activities are ticked
        let ideaSubmitted = document.getElementById("idea-submit").checked;
        let presentationDone = document.getElementById("presentation").checked;
        // Add more activity checkboxes as needed

        // Update progress based on checked activities
        updateProgress(ideaSubmitted, presentationDone); // Add more parameters if needed
    });
});

function updateProgress(ideaSubmitted, presentationDone) {
    // Calculate total progress based on checked activities
    let totalProgress = 0;
    if (ideaSubmitted) totalProgress += 50; // Each activity contributes 50% to the progress
    if (presentationDone) totalProgress += 50;

    // Update progress bar width
    document.getElementById("progress-bar").style.width = totalProgress + "%";
}
