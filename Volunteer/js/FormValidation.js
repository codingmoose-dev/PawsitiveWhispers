document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const errorList = document.getElementById("error-list");

    form.addEventListener("submit", function (event) {
        errorList.innerHTML = ""; // Clear previous errors
        let errors = [];

        function addError(message) {
            const li = document.createElement("li");
            li.textContent = message;
            errorList.appendChild(li);
        }

        // Get form elements
        const fullName = document.getElementById("FullName").value.trim();
        const email = document.getElementById("Email").value.trim();
        const phone = document.getElementById("Phone").value.trim();
        const password = document.getElementById("Password").value;
        const confirmPassword = document.getElementById("ConfirmPassword").value;
        const homeAddress = document.getElementById("HomeAddress").value.trim();
        const cityStateCountry = document.getElementById("CityStateCountry").value.trim();
        const experienceYears = document.getElementById("ExperienceYears").value;

        // Validation checks
        if (fullName === "") {
            addError("Full Name is required.");
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            addError("Invalid email format.");
        }

        const phonePattern = /^\d{3}-\d{3}-\d{3}$/;
        if (!phonePattern.test(phone)) {
            addError("Phone number must be in the format 123-456-789.");
        }

        if (password.length < 6) {
            addError("Password must be at least 6 characters long.");
        }

        if (password !== confirmPassword) {
            addError("Passwords do not match.");
        }

        if (homeAddress === "") {
            addError("Home Address is required.");
        }

        if (cityStateCountry === "") {
            addError("City/State/Country is required.");
        }

        if (experienceYears !== "" && (isNaN(experienceYears) || experienceYears < 0)) {
            addError("Experience Years must be a non-negative number.");
        }

        // Prevent form submission if there are errors
        if (errorList.children.length > 0) {
            event.preventDefault();
        }
    });
});
