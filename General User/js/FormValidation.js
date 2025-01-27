function validateForm() {
    // Access form values
    const fullName = document.forms["registrationForm"]["FullName"].value.trim();
    const email = document.forms["registrationForm"]["Email"].value.trim();
    const phone = document.forms["registrationForm"]["Phone"].value.trim();
    const password = document.forms["registrationForm"]["Password"].value;
    const confirmPassword = document.forms["registrationForm"]["ConfirmPassword"].value;
    const address = document.forms["registrationForm"]["Address"].value.trim();
    const cityStateCountry = document.forms["registrationForm"]["CityStateCountry"].value.trim();
    const location = document.forms["registrationForm"]["Location"].value;
    const adoptionNotifications = document.forms["registrationForm"]["AdoptionNotifications"].value;
    const donationCampaigns = document.forms["registrationForm"]["DonationCampaigns"].value;
    const newsletterSubscription = document.forms["registrationForm"]["NewsletterSubscription"].value;
    const emailVerification = document.forms["registrationForm"]["EmailVerification"].checked;

    // Clear previous error messages
    clearErrors();

    // Regular expressions for validation
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    const phonePattern = /^[0-9]{10,15}$/;

    let isValid = true;

    // Validation checks and error messages
    if (fullName === "") {
        document.getElementById("fullNameError").innerHTML = "Full Name is required.";
        isValid = false;
    }

    if (email === "" || !emailPattern.test(email)) {
        document.getElementById("emailError").innerHTML = "Enter a valid Email address.";
        isValid = false;
    }

    if (phone === "" || !phonePattern.test(phone)) {
        document.getElementById("phoneError").innerHTML = "Enter a valid Phone number (10-15 digits).";
        isValid = false;
    }

    if (password === "") {
        document.getElementById("passwordError").innerHTML = "Password is required.";
        isValid = false;
    }

    if (password !== confirmPassword) {
        document.getElementById("confirmPasswordError").innerHTML = "Passwords do not match.";
        isValid = false;
    }

    if (address === "") {
        document.getElementById("addressError").innerHTML = "Address is required.";
        isValid = false;
    }

    if (cityStateCountry === "") {
        document.getElementById("cityStateCountryError").innerHTML = "City/State/Country is required.";
        isValid = false;
    }

    if (!location) {
        document.getElementById("locationError").innerHTML = "Please select an option for Location Services.";
        isValid = false;
    }

    if (!adoptionNotifications) {
        document.getElementById("adoptionNotificationsError").innerHTML = "Please select an option for Adoption Notifications.";
        isValid = false;
    }

    if (!donationCampaigns) {
        document.getElementById("donationCampaignsError").innerHTML = "Please select an option for Donation Campaigns.";
        isValid = false;
    }

    if (!newsletterSubscription) {
        document.getElementById("newsletterSubscriptionError").innerHTML = "Please select an option for Newsletter Subscription.";
        isValid = false;
    }

    const profilePicture = document.forms["registrationForm"]["ProfilePicture"].value;
    if (!profilePicture) {
        document.getElementById("profilePictureError").innerHTML = "Profile picture is required.";
        isValid = false;
    }

    const socialMediaLink = document.forms["registrationForm"]["SocialMediaLink"].value.trim();
    const urlPattern = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;
    if (socialMediaLink && !urlPattern.test(socialMediaLink)) {
        document.getElementById("socialMediaLinkError").innerHTML = "Enter a valid URL.";
        isValid = false;
    }

    if (!emailVerification) {
        document.getElementById("emailVerificationError").innerHTML = "You must confirm your email verification.";
        isValid = false;
    }

    return isValid;
}

// Function to clear error messages
function clearErrors() {
    const errorFields = document.getElementsByClassName("error");
    for (let i = 0; i < errorFields.length; i++) {
        errorFields[i].innerHTML = "";
    }
}
