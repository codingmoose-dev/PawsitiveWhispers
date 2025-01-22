
function validateForm() {
    
    const form = document.forms["registrationForm"];
    const licenseNumber = form["lisence"].value.trim();
    const clinicName = form["clinicname"].value.trim();
    const licenseFile = form["vet_license"].value;


    if (!licenseNumber) {
        alert("Please provide your Medical License Number.");
        return false;
    }

    
    if (!clinicName) {
        alert("Please provide the Clinic Name.");
        return false;
    }

    
    if (!licenseFile) {
        alert("Please upload your Veterinary or Medical License file.");
        return false;
    }

    
    alert("Form submitted successfully!");
    return true;
}
