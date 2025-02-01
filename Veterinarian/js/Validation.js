function validateForm() {
    let errorContainer = document.getElementById("errorMessages");
    errorContainer.innerHTML = ""; // Clear previous errors
    let errors = [];

    const FullName = document.forms["registrationForm"]["FullName"].value;
    const Email = document.forms["registrationForm"]["Email"].value;
    const Phone = document.forms["registrationForm"]["Phone"].value;
    const Password = document.forms["registrationForm"]["Password"].value;
    const ConfirmPassword = document.forms["registrationForm"]["ConfirmPassword"].value;
    const ClinicAddress = document.forms["registrationForm"]["ClinicAddress"].value;
    const License = document.forms["registrationForm"]["License"].value;
    const ClinicName = document.forms["registrationForm"]["ClinicName"].value;
    const Speciality = document.forms["registrationForm"]["Speciality"].value;
    const Services = document.forms["registrationForm"]["Services"].value;
    const WorkingHours = document.forms["registrationForm"]["WorkingHours"].value;
    const VetLicensePath = document.forms["registrationForm"]["VetLicensePath"].value;
    const GovIDPath = document.forms["registrationForm"]["GovIDPath"].value;
    const TrainingMaterialsPath = document.forms["registrationForm"]["TrainingMaterialsPath"].value;
    const HostTraining = document.forms["registrationForm"]["HostTraining"].value;

    // Validate Full Name
    if (FullName === "") {
        errors.push("Full Name is required.");
    }

    // Validate Email
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9]{2,6}$/;
    if (Email === "" || !Email.match(emailRegex)) {
        errors.push("Please enter a valid email address.");
    }

    // Validate Phone Number
    const phoneRegex = /^[0-9]{11}$/;
    if (Phone === "" || !Phone.match(phoneRegex)) {
        errors.push("Please enter a valid phone number (11 digits).");
    }

    // Validate Password
    if (Password === "") {
        errors.push("Password is required.");
    }

    if (ConfirmPassword === "") {
        errors.push("Please confirm your password.");
    }
    
    if (Password !== ConfirmPassword) {
        errors.push("Passwords do not match.");
    }

    // Validate Clinic Address
    if (ClinicAddress === "") {
        errors.push("Clinic address is required.");
    }

    // Validate Medical Licence Number
    if (License === "") {
        errors.push("Medical License Number is required.");
    }

    // Validate Clinic Name
    if (ClinicName === "") {
        errors.push("Clinic Name is required.");
    }

    // Validate Speciality
    if (Speciality === "") {
        errors.push("Please select a speciality.");
    }

    // Validate Offered Services
    if (Services === "") {
        errors.push("Please select at least one service offered.");
    }

    // Validate Working Hours
    if (WorkingHours === "") {
        errors.push("Availability Schedule is required.");
    }

    // Validate File Uploads
    if (VetLicensePath === "") {
        errors.push("Please upload your Veterinary or Medical License.");
    }
    if (GovIDPath === "") {
        errors.push("Please upload your Government-issued ID.");
    }

    // Validate Training Materials (optional)
    if (HostTraining === "") {
        errors.push("Please select whether you want to host training sessions.");
    }

    if (errors.length > 0) {
        errorContainer.innerHTML = "<ul><li>" + errors.join("</li><li>") + "</li></ul>";
        return false;
    }

    return true;
}
