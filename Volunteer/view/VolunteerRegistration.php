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
        <p> Are you are a Volunteer? Register below to offer your services to our animal rescue platform!</p>
    </section>

    <section id="registration">
        <h2>Volunteer Registration Form</h2>
        <p>Fill in the form below to register as a volunteer on our platform.</p>
        <form action="" method="post" enctype="multipart/form-data">

            <fieldset>
                <legend>Personal Information</legend>
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" placeholder="Your full name">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="email@example.com">

                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" placeholder="123-456-789">

                <label for="password">Password:</label>
                <input type="password" id="password" name="password">

                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password">
            </fieldset>

            <fieldset>
                <legend>Location</legend>
                <label for="home_address">Home Address:</label>
                <input type="text" id="home_address" name="home_address">

                <label for="city_state_country">City/State/Country:</label>
                <input type="text" id="city_state_country" name="city_state_country">

                <p>Enable Location Services:</p>
                <input type="radio" id="location-yes" name="location_enabled" value="Yes">
                <label for="location-yes">Yes</label>
                <input type="radio" id="location-no" name="location_enabled" value="No">
                <label for="location-no">No</label>
            </fieldset>

            <fieldset>
                <legend>Preferences</legend>
                <p>Available for Emergency Rescue Missions:</p>
                <input type="radio" id="emergency-yes" name="emergency_rescue" value="yes">
                <label for="emergency-yes">Yes</label>
                <input type="radio" id="emergency-no" name="emergency_rescue" value="no">
                <label for="emergency-no">No</label>

                <p>Willing to Organize Campaigns:</p>
                <input type="radio" id="organize-yes" name="organize_campaigns" value="yes">
                <label for="organize-yes">Yes</label>
                <input type="radio" id="organize-no" name="organize_campaigns" value="no">
                <label for="organize-no">No</label>

                <p>Willing to Manage Adoption Approvals:</p>
                <input type="radio" id="adoption-yes" name="manage_adoption" value="yes">
                <label for="adoption-yes">Yes</label>
                <input type="radio" id="adoption-no" name="manage_adoption" value="no">
                <label for="adoption-no">No</label>
            </fieldset>
            
            <fieldset>
                <legend>Skills and Experience</legend>
                <label for="skills">Skills:</label>
                <select id="skills" name="skills">
                    <option value="Animal Handling">Animal Handling</option>
                    <option value="First Aid for Animals">First Aid for Animals</option>
                    <option value="Driving">Driving (for transporting animals)</option>
                    <option value="Event Planning">Event Planning</option>
                    <option value="Social Media Management">Social Media Management</option>
                    <option value="Veterinary Assistance">Veterinary Assistance (if not a licensed veterinarian)</option>
                </select>

                <label for="experience_years">Years of Experience:</label>
                <input type="number" id="experience_years" name="experience_years" min="0" step="1" placeholder="Enter years of experience">
            </fieldset>

            <fieldset>
                <legend>Availability</legend>
                <label for="availability">What is the best time for you to volunteer in rescue missions?</label>
                <select id="availability" name="availability">
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

            <div class="button">
                <input type="submit" value="Submit">
            </div>      
        </form>
    </section>

    <footer>
        <p> &copy; 2024 PawsitiveWellbeing. All rights reserved.</p>
    </footer>
    
    <script src="../js/FormValidation.js"></script>

</body>
</html>
