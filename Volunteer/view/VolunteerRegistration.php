<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/Style.css">
    <title>Volunteer</title>
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
        <p>Are you a Volunteer? Register below to offer your services to our animal rescue platform!</p>
    </section>

    <section id="registration">
        <h2>Volunteer Registration Form</h2>
        <p>Fill in the form below to register as a volunteer on our platform.</p>
        <form action="../control/user_control.php" method="post" enctype="multipart/form-data">


            <fieldset>
                <legend>Personal Information</legend>
                <label for="FullName">Full Name:</label>
                <input type="text" id="FullName" name="FullName" placeholder="Your full name">

                <label for="Email">Email:</label>
                <input type="email" id="Email" name="Email" placeholder="email@example.com">

                <label for="Phone">Phone:</label>
                <input type="tel" id="Phone" name="Phone" placeholder="123-456-789">

                <label for="Password">Password:</label>
                <input type="password" id="Password" name="Password">

                <label for="ConfirmPassword">Confirm Password:</label>
                <input type="password" id="ConfirmPassword" name="ConfirmPassword">
            </fieldset>

            <fieldset>
                <legend>Location</legend>
                <label for="HomeAddress">Home Address:</label>
                <input type="text" id="HomeAddress" name="HomeAddress">

                <label for="CityStateCountry">City/State/Country:</label>
                <input type="text" id="CityStateCountry" name="CityStateCountry">

                <p>Enable Location Services:</p>
                <input type="radio" id="LocationEnabledYes" name="LocationEnabled" value="Yes">
                <label for="LocationEnabledYes">Yes</label>
                <input type="radio" id="LocationEnabledNo" name="LocationEnabled" value="No">
                <label for="LocationEnabledNo">No</label>
            </fieldset>

            <fieldset>
                <legend>Preferences</legend>
                <p>Available for Emergency Rescue Missions:</p>
                <input type="radio" id="EmergencyRescueYes" name="EmergencyRescue" value="Yes">
                <label for="EmergencyRescueYes">Yes</label>
                <input type="radio" id="EmergencyRescueNo" name="EmergencyRescue" value="No">
                <label for="EmergencyRescueNo">No</label>

                <p>Willing to Organize Campaigns:</p>
                <input type="radio" id="OrganizeCampaignsYes" name="OrganizeCampaigns" value="Yes">
                <label for="OrganizeCampaignsYes">Yes</label>
                <input type="radio" id="OrganizeCampaignsNo" name="OrganizeCampaigns" value="No">
                <label for="OrganizeCampaignsNo">No</label>

                <p>Willing to Manage Adoption Approvals:</p>
                <input type="radio" id="ManageAdoptionYes" name="ManageAdoption" value="Yes">
                <label for="ManageAdoptionYes">Yes</label>
                <input type="radio" id="ManageAdoptionNo" name="ManageAdoption" value="No">
                <label for="ManageAdoptionNo">No</label>
            </fieldset>
            
            <fieldset>
                <legend>Skills and Experience</legend>
                <label for="Skills">Skills:</label>
                <select id="Skills" name="Skills">
                    <option value="Animal Handling">Animal Handling</option>
                    <option value="First Aid for Animals">First Aid for Animals</option>
                    <option value="Driving">Driving (for transporting animals)</option>
                    <option value="Event Planning">Event Planning</option>
                    <option value="Social Media Management">Social Media Management</option>
                    <option value="Veterinary Assistance">Veterinary Assistance (if not a licensed veterinarian)</option>
                </select>

                <label for="ExperienceYears">Years of Experience:</label>
                <input type="number" id="ExperienceYears" name="ExperienceYears" min="0" step="1" placeholder="Enter years of experience">
            </fieldset>

            <fieldset>
                <legend>Availability</legend>
                <label for="Availability">What is the best time for you to volunteer in rescue missions?</label>
                <select id="Availability" name="Availability">
                    <option value="Weekends">Weekends</option>
                    <option value="Weekdays">Weekdays</option>
                    <option value="Morning">Morning</option>
                    <option value="Afternoon">Afternoon</option>
                    <option value="Evening">Evening</option>
                    <option value="Anytime">Anytime</option>
                </select>
            </fieldset>

            <!-- This is where the error messages will be listed -->
            <section id="error-messages">
                <ul id="error-list"></ul>  
            </section>
            <div>
                <button type="submit" name="register">Submit</button>
            </div>
        </form>
    </section>

    <footer>
        <p> &copy; 2024 PawsitiveWellbeing. All rights reserved.</p>
    </footer>
    
    <script src="../js/FormValidation.js"></script>

</body>
</html>