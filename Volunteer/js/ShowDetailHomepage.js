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


// Show the search bar when the "Collaborate" button is clicked
document.getElementById('collaborate-btn').addEventListener('click', function() {
    this.style.display = "none";  // Hide the Collaborate Button
    document.getElementById('search-bar').style.display = 'block';  // Show Search Bar
});

// Handle search functionality (form submission)
document.getElementById('search-btn').addEventListener('click', function() {
    var volunteerID = document.getElementById('volunteer-id').value;
    
    if (volunteerID) {
        // Clear previous results or error messages
        document.getElementById('volunteer-details').style.display = 'none';  // Hide details section initially
        document.getElementById('volunteer-table').innerHTML = '';  // Clear table content
        var loadingMessage = document.createElement('p');
        loadingMessage.textContent = 'Loading...';
        document.getElementById('volunteer-details').appendChild(loadingMessage);

        // Create an AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_volunteer.php?id=" + volunteerID, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;

                // Clear loading message
                document.getElementById('volunteer-details').innerHTML = '';

                if (response !== "No volunteer found.") {
                    var volunteer = response.split(",");

                    // Get the volunteer details table and clear it
                    var table = document.getElementById("volunteer-table");

                    // Add table headers
                    var headerRow = table.insertRow();
                    var headers = ["VolunteerID", "FullName", "Email", "Phone", "Location", "Experience Years"];
                    headers.forEach(function(header) {
                        var cell = headerRow.insertCell();
                        cell.textContent = header;
                    });

                    // Add volunteer details to the table
                    var row = table.insertRow();
                    volunteer.forEach(function(detail) {
                        var cell = row.insertCell();
                        cell.textContent = detail;
                    });

                    // Show the volunteer details section
                    document.getElementById("volunteer-details").style.display = "block";
                } else {
                    // Display a message instead of using alert
                    document.getElementById("volunteer-details").innerHTML = "<p>No volunteer found with that ID.</p>";
                    document.getElementById("volunteer-details").style.display = "block";
                }
            }
        };
        xhr.send();
    } else {
        document.getElementById("volunteer-details").innerHTML = "<p>Please enter a valid Volunteer ID.</p>";
    }
});