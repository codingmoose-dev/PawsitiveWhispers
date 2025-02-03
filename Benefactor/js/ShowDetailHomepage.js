document.addEventListener('DOMContentLoaded', function () {
    const donateButton = document.getElementById('show-more-donate');
    const donateContent = document.getElementById('donate-more-content');

    if (donateButton && donateContent) {
        donateButton.addEventListener('click', function () {
            donateContent.style.display = 'block'; 
            donateButton.style.display = 'none';  
        });
    } else {
        console.error('Button or content not found!');
    }
});


document.getElementById("donate-btn").addEventListener("click", function(event) {
    event.preventDefault(); 

    var campaignId = document.getElementById("campaign-id").value;
    var donationAmount = document.getElementById("campaign-amount").value;

    // Validation
    if (!campaignId || !donationAmount) {
        document.getElementById("message").innerHTML = "Please fill in both fields.";
        return;
    }


    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../control/reg_control.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (xhr.status == 200) {
            var response = xhr.responseText; 
            if (response == "success") {
                document.getElementById("message").innerHTML = "Donation successful! Raised amount updated.";
            } else {
                document.getElementById("message").innerHTML = "Failed to donate. Please try again.";
            }
        }
    };
    var params = "campaign-id=" + campaignId + "&campaign-amount=" + donationAmount;
    xhr.send(params);
});
