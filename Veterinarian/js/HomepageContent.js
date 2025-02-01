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

// Accept mission action (for Pending status)
function acceptMission(missionID) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../control/UserController.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("missionID=" + missionID + "&status=In Progress");  // Sending status as 'In Progress'
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            
            if (response === "success") {
                var row = document.getElementById('mission-' + missionID);
                row.cells[6].textContent = 'In Progress';  
                row.cells[8].innerHTML = 'Accepted';  
                row.cells[8].setAttribute('onclick', 'completeMission(' + missionID + ')'); // Update function for 'Complete'
            } else {
                alert('Failed to accept mission. Please try again.');
            }
        }
    };
}

// Complete mission action (for In Progress status)
function completeMission(missionID) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../control/UserController.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("missionID=" + missionID + "&status=Completed");  // Sending status as 'Completed'
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            
            if (response === "success") {
                var row = document.getElementById('mission-' + missionID);
                row.cells[6].textContent = 'Completed';  
                row.cells[8].innerHTML = ''; 
            } else {
                alert('Failed to complete mission. Please try again.');
            }
        }
    };
}
