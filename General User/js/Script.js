// Show shelters dropdown when the case type is "adoption"
document.getElementById('case_type').addEventListener('change', function () {
    const messageDiv = document.getElementById('message'); // Message display element
    if (this.value === 'adoption') {
        document.getElementById('shelterDropdown').style.display = 'block';

        // Create XMLHttpRequest to fetch shelter data
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '../controllers/SubmitCaseController.php?fetchShelters=true', true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const shelters = JSON.parse(xhr.responseText);
                const shelterSelect = document.getElementById('shelter');
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
        document.getElementById('shelter').innerHTML = '';
        messageDiv.innerHTML = ''; // Clear any previous messages
    }
});

// Handle form submission
document.getElementById('animalForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    const messageDiv = document.getElementById('message'); // Message display element

    // Create XMLHttpRequest for form submission
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../controllers/SubmitCaseController.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);

            // Display success or error message based on response
            if (response.success) {
                messageDiv.style.color = 'green';
                messageDiv.innerHTML = response.message;

                // Reset form and hide shelter dropdown on success
                document.getElementById('animalForm').reset();
                document.getElementById('shelterDropdown').style.display = 'none';
            } else {
                messageDiv.style.color = 'red';
                messageDiv.innerHTML = response.message;
            }
        } else if (xhr.readyState === 4) {
            // Handle submission error
            messageDiv.style.color = 'red';
            messageDiv.innerHTML = 'Form submission failed.';
        }
    };

    // Serialize form data for submission
    const formData = new URLSearchParams(new FormData(this)).toString();

    // Send form data
    xhr.send(formData);
});
