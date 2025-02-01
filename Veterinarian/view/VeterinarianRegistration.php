<?php
include '../control/UserController.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Veterinarian Registration</title>
    <link rel="stylesheet" type="text/css" href="../css/Style.css">
</head>
<body>
<header>
        <div id="logo-container">
            <img src="../../Main/images/Icon.png" alt="PawsitiveWellbeing Logo">
            <h1>Pawsitive Wellbeing</h1>
        </div>
    </header>
    <section id="message">
        <h2>Welcome to our Animal Rescue Platform</h2>
        <p>Our mission is to rescue, rehabilitate, and rehome stray animals. Join us in making a difference!</p>
        <p> Are you are a veterinarian? Register below to offer your services to our animal rescue platform!</p>
    </section>

    <section id="registration">
        <h2>Veterinarian Registration Form</h2>
        <p>Fill in the form below to register as a veterinarian on our platform.</p>

        <form name="registrationForm" method="POST" action="" onsubmit="return validateForm()" enctype="multipart/form-data">
            <fieldset>
                <legend>Personal Information</legend>
                <label for="FullName">Full Name: </label>
                <input type="text" id="FullName" name="FullName"><br>

                <label for="Email">Email: </label>
                <input type="email" id="Email" name="Email" placeholder="email@example.com"><br>

                <label for="Phone">Phone: </label>
                <input type="tel" id="Phone" name="Phone" placeholder="0123456789"><br>

                <label for="Password">Password: </label>
                <input type="password" id="Password" name="Password"><br>

                <label for="ConfirmPassword">Confirm Password: </label>
                <input type="password" id="ConfirmPassword" name="ConfirmPassword"><br>
            </fieldset>

            <fieldset>
                <legend>Location</legend>
                <label for="ClinicAddress">Clinic Address: </label>
                <textarea id="ClinicAddress" name="ClinicAddress"></textarea><br>

                <label>Enable Location service: </label>
                <input type="radio" id="LocationEnabledYes" name="LocationEnabled" value="yes">
                <label for="LocationEnabledYes">Yes</label>
                <input type="radio" id="LocationEnabledNo" name="LocationEnabled" value="no">
                <label for="LocationEnabledNo">No</label><br>
            </fieldset>

            <fieldset>
                <legend>Professional Information</legend>
                <label for="License">Medical License Number: </label>
                <input type="number" id="License" name="License"><br>

                <label for="ClinicName">Clinic Name: </label>
                <input type="text" id="ClinicName" name="ClinicName"><br>

                <label for="Speciality">Speciality: </label>
                <select id="Speciality" name="Speciality">
                    <option value="" selected disabled>Select Speciality</option>
                    <option value="Surgery">Surgery</option>
                    <option value="General Practice">General Practice</option>
                </select><br>
            </fieldset>

            <fieldset>
                <legend>Services</legend>
                <label for="Services">Select Offered Services: </label>
                <select id="Services" name="Services">
                    <option value="" selected disabled>Select a Service</option>
                    <option value="Emergency Care">Emergency Care</option>
                    <option value="Surgery">Surgery</option>
                    <option value="Vaccinations">Vaccinations</option>
                    <option value="Other">Other</option>
                </select><br>

                <label for="WorkingHours">Availability Schedule: </label>
                <input type="text" id="WorkingHours" name="WorkingHours" placeholder="e.g., Mon-Fri, 9am-5pm"><br>
            </fieldset>

            <fieldset>
                <legend>Upload Verification Documents</legend>
                <label for="VetLicensePath">Veterinary or Medical License: </label>
                <input type="file" id="VetLicensePath" name="VetLicensePath" accept=".pdf, .jpg, .jpeg, .png"><br>

                <label for="GovIDPath">Government-issued ID: </label>
                <input type="file" id="GovIDPath" name="GovIDPath" accept=".pdf, .jpg, .jpeg, .png"><br>
            </fieldset>

            <fieldset>
                <legend>Training (Optional)</legend>
                <label for="TrainingMaterialsPath">Upload or Manage Training Materials: </label>
                <input type="file" id="TrainingMaterialsPath" name="TrainingMaterialsPath" accept=".pdf, .jpg, .jpeg, .png"><br>

                <label>Opt-in to Host Training Sessions: </label>
                <input type="radio" id="HostTrainingYes" name="HostTraining" value="yes">
                <label for="HostTrainingYes">Yes</label>
                <input type="radio" id="HostTrainingNo" name="HostTraining" value="no">
                <label for="HostTrainingNo">No</label><br>
            </fieldset>

            <div id="errorMessages" style="color: red;"></div>

            <div>
                <button type="submit" name="register">Submit</button>
            </div>
        </form>
    </section>
    
    <footer>
        <p> &copy; 2024 PawsitiveWellbeing. All rights reserved.</p>
    </footer>
    
    <script src="../js/Validation.js" defer></script>

</body>
</html>
