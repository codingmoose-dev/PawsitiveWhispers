<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="../css/Style.css">
</head>
<body>
<form name="registrationForm" method="POST" action="" onsubmit="return validateForm()" enctype="multipart/form-data">
    <fieldset>
        <legend>Personal Information</legend>
        <div>
            <label for="FullName">Full Name: </label>
            <input type="text" id="FullName" name="FullName">
        </div>
        <div>
            <label for="Email">Email: </label>
            <input type="email" id="Email" name="Email" placeholder="email@example.com">
        </div>
        <div>
            <label for="Phone">Phone: </label>
            <input type="tel" id="Phone" name="Phone" placeholder="0123456789">
        </div>
        <div>
            <label for="Password">Password: </label>
            <input type="password" id="Password" name="Password">
        </div>
        <div>
            <label for="ConfirmPassword">Confirm Password: </label>
            <input type="password" id="ConfirmPassword" name="ConfirmPassword">
        </div>
    </fieldset>

    <fieldset>
        <legend>Location</legend>
        <div>
            <label for="ClinicAddress">Clinic Address: </label>
            <textarea id="ClinicAddress" name="ClinicAddress"></textarea>
        </div>
        <div>
            <label>Enable Location service: </label>
            <input type="radio" id="LocationEnabledYes" name="LocationEnabled" value="yes">
            <label for="LocationEnabledYes">Yes</label>
            <input type="radio" id="LocationEnabledNo" name="LocationEnabled" value="no">
            <label for="LocationEnabledNo">No</label>
        </div>
    </fieldset>

    <fieldset>
        <legend>Professional Information</legend>
        <div>
            <label for="License">Medical License Number: </label>
            <input type="number" id="License" name="License">
        </div>
        <div>
            <label for="ClinicName">Clinic Name: </label>
            <input type="text" id="ClinicName" name="ClinicName">
        </div>
        <div>
            <label for="Speciality">Speciality: </label>
            <select id="Speciality" name="Speciality">
                <option value="" selected disabled>Select Speciality</option>
                <option value="Surgery">Surgery</option>
                <option value="General Practice">General Practice</option>
            </select>
        </div>
    </fieldset>

    <fieldset>
        <legend>Services</legend>
        <div>
            <label for="Services">Select Offered Services: </label>
            <select id="Services" name="Services">
                <option value="" selected disabled>Select a Service</option>
                <option value="Emergency Care">Emergency Care</option>
                <option value="Surgery">Surgery</option>
                <option value="Vaccinations">Vaccinations</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div>
            <label for="WorkingHours">Availability Schedule: </label>
            <input type="text" id="WorkingHours" name="WorkingHours" placeholder="e.g., Mon-Fri, 9am-5pm">
        </div>
    </fieldset>

    <fieldset>
        <legend>Upload Verification Documents</legend>
        <div>
            <label for="VetLicensePath">Veterinary or Medical License: </label>
            <input type="file" id="VetLicensePath" name="VetLicensePath" accept=".pdf, .jpg, .jpeg, .png">
        </div>
        <div>
            <label for="GovIDPath">Government-issued ID: </label>
            <input type="file" id="GovIDPath" name="GovIDPath" accept=".pdf, .jpg, .jpeg, .png">
        </div>
    </fieldset>

    <fieldset>
        <legend>Training (Optional)</legend>
        <div>
            <label for="TrainingMaterialsPath">Upload or Manage Training Materials: </label>
            <input type="file" id="TrainingMaterialsPath" name="TrainingMaterialsPath" accept=".pdf, .doc, .docx">
        </div>
        <div>
            <label>Opt-in to Host Training Sessions: </label>
            <input type="radio" id="HostTrainingYes" name="HostTraining" value="yes">
            <label for="HostTrainingYes">Yes</label>
            <input type="radio" id="HostTrainingNo" name="HostTraining" value="no">
            <label for="HostTrainingNo">No</label>
        </div>
    </fieldset>

    <div id="errorMessages" style="color: red;"></div>

    <div>
        <button type="submit">Submit</button>
    </div>
</form>

<script src="../js/Validation.js" defer></script>

</body>
</html>
