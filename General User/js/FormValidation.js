function validateForm() {
    
    const password = document.forms["registrationForm"]["Password"].value;
    const confirmPassword = document.forms["registrationForm"]["ConfirmPassword"].value;
    if (password !== confirmPassword) {
        required("Passwords do not match!");
        return false;
    }

    
    const profilePicture = document.forms["registrationForm"]["ProfilePicture"].value;
    if (profilePicture === "") {
        ("Please upload a profile picture!");
        return false;
    }

    
    const emailVerified = document.forms["registrationForm"]["EmailVerification"].checked;
    if (!emailVerified) {
        ("You must confirm email verification!");
        return false;
    }

    
    return true;
}
