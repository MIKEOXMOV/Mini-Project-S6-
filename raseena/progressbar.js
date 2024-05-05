document.addEventListener("DOMContentLoaded", function() {
    const ideaSubmissionCheckbox = document.getElementById("ideaSubmission");
    const presentationCheckbox = document.getElementById("presentation");
    const progressCircle = document.querySelector(".progress-circle");
    const progressText = document.getElementById("progressText");

    const updateProgress = (activityName, completed) => {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "progressbar.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                console.log(xhr.responseText);
            }
        };
        xhr.send(`activity_name=${activityName}&completed=${completed}`);
    };

    ideaSubmissionCheckbox.addEventListener("change", () => {
        const activityName = "Idea Submission";
        const completed = ideaSubmissionCheckbox.checked ? 1 : 0;
        updateProgress(activityName, completed);
        updateProgressBar();
    });

    presentationCheckbox.addEventListener("change", () => {
        const activityName = "Presentation";
        const completed = presentationCheckbox.checked ? 1 : 0;
        updateProgress(activityName, completed);
        updateProgressBar();
    });

    function updateProgressBar() {
        const completedActivities = [ideaSubmissionCheckbox.checked, presentationCheckbox.checked].filter(Boolean).length;
        const totalActivities = document.querySelectorAll(".activities input[type='checkbox']").length;
        const progressPercentage = (completedActivities / totalActivities) * 100;

        progressCircle.style.transform = `rotate(${(progressPercentage * 3.6) - 90}deg)`; // Convert percentage to degrees
        progressText.textContent = `${Math.round(progressPercentage)}%`;
    }
});
