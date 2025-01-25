function validateForm() {
    const errorDiv = document.getElementById('error-messages');
    errorDiv.innerHTML = ""; 
    
    // Validate Full Name
    const fullName = document.getElementById('fname').value.trim();
    if (!fullName) {
        errorDiv.innerHTML = "Please enter your full name or organization name.";
        return false;
    }

    // Validate Email
    const email = document.getElementById('email').value.trim();
    if (!email || !/^\S+@\S+\.\S+$/.test(email)) {
        errorDiv.innerHTML = "Please enter a valid email address.";
        return false;
    }

    // Validate Captcha
    const captcha = document.getElementById('captcha').value.trim();
    if (!captcha) {
        errorDiv.innerHTML = "Captcha field cannot be empty.";
        return false;
    }

    // All validations passed
    return true;
}
