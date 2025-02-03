// Show Details in Homepage when the user clicks on the "Donate Now" button
document.addEventListener('DOMContentLoaded', function () {
    const donateButton = document.getElementById('show-more-donate');
    const donateContent = document.getElementById('donate-more-content');

    if (donateButton && donateContent) {
        donateButton.addEventListener('click', function () {
            donateContent.style.display = 'block'; // Show hidden content
            donateButton.style.display = 'none';  // Hide the button
        });
    } else {
        console.error('Button or content not found!');
    }
});


document.getElementById("donate-btn").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent form submission

    var campaignId = document.getElementById("campaign-id").value;
    var donationAmount = document.getElementById("campaign-amount").value;

    // Validation
    if (!campaignId || !donationAmount) {
        document.getElementById("message").innerHTML = "Please fill in both fields.";
        return;
    }

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    
    // Configure it as a POST request to 'donate.php'
    xhr.open("POST", "../control/reg_control.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // When the request is complete, handle the response
    xhr.onload = function() {
        if (xhr.status == 200) {
            var response = xhr.responseText; // Response from the server
            if (response == "success") {
                document.getElementById("message").innerHTML = "Donation successful! Raised amount updated.";
            } else {
                document.getElementById("message").innerHTML = "Failed to donate. Please try again.";
            }
        }
    };

    // Send the request with the campaign ID and donation amount
    var params = "campaign-id=" + campaignId + "&campaign-amount=" + donationAmount;
    xhr.send(params);
});
