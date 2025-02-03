function validateForm() {
    let isValid = true;
    let errors = "";

    // Get form values
    let fullName = document.getElementById("fname").value.trim();
    let email = document.getElementById("email").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let password = document.getElementById("pwd").value;
    let confirmPassword = document.getElementById("cpwd").value;
    let address = document.getElementById("address").value.trim();
    let captcha = document.getElementById("captcha").value.trim();
    let termsChecked = document.getElementById("terms-conditions").checked;

    // Error display container
    let errorContainer = document.getElementById("error-messages");
    if (!errorContainer) {
        errorContainer = document.createElement("div");
        errorContainer.id = "error-messages";
        errorContainer.style.color = "red";
        document.querySelector("form").prepend(errorContainer);
    }
    errorContainer.innerHTML = ""; 

    // Full name validation
    if (fullName === "") {
        errors += "<p>Full Name is required.</p>";
        isValid = false;
    }

    // Email validation
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.match(emailPattern)) {
        errors += "<p>Enter a valid email.</p>";
        isValid = false;
    }

    // Phone validation
    let phonePattern = /^\+?\d{1,3}[-.\s]?\d{3}[-.\s]?\d{3,4}[-.\s]?\d{4}$/;
    if (!phone.match(phonePattern)) {
        errors += "<p>Enter a valid phone number.</p>";
        isValid = false;
    }

    if (password !== confirmPassword) {
        errors += "<p>Passwords do not match.</p>";
        isValid = false;
    }

    // Address validation
    if (address === "") {
        errors += "<p>Address is required.</p>";
        isValid = false;
    }

    // Captcha validation
    if (captcha !== "3bIHDas") {
        errors += "<p>Captcha did not match.</p>";
        isValid = false;
    }

    // Terms and conditions validation
    if (!termsChecked) {
        errors += "<p>You must agree to the Terms & Conditions.</p>";
        isValid = false;
    }

    // Display errors or submit form
    if (!isValid) {
        errorContainer.innerHTML = errors;
    }

    return isValid;
}