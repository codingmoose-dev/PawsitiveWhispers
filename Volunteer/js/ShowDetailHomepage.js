document.addEventListener('DOMContentLoaded', function () {
    const RescueMissionButton = document.getElementById('show-rescue-missions');
    const RescueMissionContent = document.getElementById('rescue-missions-content');

    if (RescueMissionButton && RescueMissionContent) {
        RescueMissionButton.addEventListener('click', function () {
            RescueMissionContent.style.display = 'block'; // Show hidden content
            RescueMissionButton.style.display = 'none';  // Hide the button
        });
    } else {
        console.error('Button or content not found!');
    }
});
