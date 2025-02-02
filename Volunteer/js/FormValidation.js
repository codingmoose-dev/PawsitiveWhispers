document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
        let isValid = true;
        let errorMessages = [];

        // Clear any previous error messages
        const errorList = document.getElementById("error-list");
        errorList.innerHTML = "";

        // Full Name validation
        const fullName = document.getElementById("full_name");
        if (fullName.value.trim() === "") {
            errorMessages.push("Full Name is required.");
            isValid = false;
        }

        // Email validation
        const email = document.getElementById("email");
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email.value)) {
            errorMessages.push("Enter a valid email address.");
            isValid = false;
        }

        // Phone validation (basic format: 123-456-7890)
        const phone = document.getElementById("phone");
        const phonePattern = /^\d{3}-\d{3}-\d{4}$/;
        if (!phonePattern.test(phone.value)) {
            errorMessages.push("Enter a valid phone number (format: 123-456-7890).");
            isValid = false;
        }

        // Password validation
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirm_password");
        if (password.value.length < 6) {
            errorMessages.push("Password must be at least 6 characters long.");
            isValid = false;
        }
        if (password.value !== confirmPassword.value) {
            errorMessages.push("Passwords do not match.");
            isValid = false;
        }

        // Home Address validation
        const homeAddress = document.getElementById("home_address");
        if (homeAddress.value.trim() === "") {
            errorMessages.push("Home Address is required.");
            isValid = false;
        }

        // City/State/Country validation
        const cityStateCountry = document.getElementById("city_state_country");
        if (cityStateCountry.value.trim() === "") {
            errorMessages.push("City/State/Country is required.");
            isValid = false;
        }

        // Years of Experience validation (must be a non-negative number)
        const experienceYears = document.getElementById("experience_years");
        if (experienceYears.value !== "" && (isNaN(experienceYears.value) || experienceYears.value < 0)) {
            errorMessages.push("Enter a valid number for years of experience.");
            isValid = false;
        }

        // If there are any errors, display them
        if (!isValid) {
            event.preventDefault();  // Prevent form submission
            errorMessages.forEach(function (message) {
                const listItem = document.createElement("li");
                listItem.textContent = message;
                errorList.appendChild(listItem);
            });
        }
    });
});
