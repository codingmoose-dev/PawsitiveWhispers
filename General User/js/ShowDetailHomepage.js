document.addEventListener('DOMContentLoaded', function () {
    const SubmitCaseButton = document.getElementById('show-submit-case');
    const SubmitCaseContent = document.getElementById('SubmitCaseContent');

    if (SubmitCaseButton && SubmitCaseContent) {
        SubmitCaseButton.addEventListener('click', function () {
            SubmitCaseContent.style.display = 'block'; // Show hidden content
            SubmitCaseButton.style.display = 'none';  // Hide the button
        });
    } else {
        console.error('Button or content not found!');
    }
});


document.getElementById('CaseType').addEventListener('change', function () {
    const messageDiv = document.getElementById('message'); // Message display element
    if (this.value === 'adoption') {
        document.getElementById('shelterDropdown').style.display = 'block';

        // Create XMLHttpRequest to fetch shelter data
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '../controllers/SubmitCaseController.php?fetchShelters=true', true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const shelters = JSON.parse(xhr.responseText);
                const shelterSelect = document.getElementById('ShelterID');
                shelterSelect.innerHTML = ''; // Clear previous options

                shelters.forEach(function (shelter) {
                    const option = document.createElement('option');
                    option.value = shelter.ShelterID;
                    option.textContent = shelter.Name;
                    shelterSelect.appendChild(option);
                });

                // Show a message indicating shelters loaded
                messageDiv.style.color = 'green';
                messageDiv.innerHTML = 'Shelters loaded successfully!';
            } else if (xhr.readyState === 4) {
                // Handle errors in fetching shelters
                messageDiv.style.color = 'red';
                messageDiv.innerHTML = 'Failed to load shelters.';
            }
        };

        xhr.send();
    } else {
        // Hide shelter dropdown for non-adoption cases
        document.getElementById('shelterDropdown').style.display = 'none';
        document.getElementById('ShelterID').innerHTML = '';
        messageDiv.innerHTML = ''; // Clear any previous messages
    }
});
