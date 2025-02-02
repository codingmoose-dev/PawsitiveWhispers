<?php
include '../control/reg_control.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Care and Pet Adoption Platform - Registration Form</title>
    <link rel="stylesheet" href="../css/Style.css">

</head>
<body>    
    <header>
        <div id="logo-container">
            <img src="../../Main/images/Icon.png" alt="PawsitiveWellbeing Logo">
            <h1>PawsitiveWellbeing</h1>
        </div>
    </header>
    <section id="message">
        <h2>Welcome to our Animal Rescue Platform</h2>
        <p>Our mission is to rescue, rehabilitate, and rehome stray animals. Join us in making a difference!</p>
    </section>


    <section id="registration">
    <form name="registrationForm" action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        
        <section>
            <fieldset>
                <legend>Basic Information</legend>
                <label>Full Name: <input type="text" name="FullName"></label>
                <span id="fullNameError" class="error" style="color: red;"></span><br>
                
                <label>Email: <input type="text" name="Email"></label>
                <span id="emailError" class="error" style="color: red;"></span><br>
                
                <label>Phone: <input type="text" name="Phone"></label>
                <span id="phoneError" class="error" style="color: red;"></span><br>
                
                <label>Password: <input type="password" name="Password"></label>
                <span id="passwordError" class="error" style="color: red;"></span><br>
                
                <label>Confirm Password: <input type="password" name="ConfirmPassword"></label>
                <span id="confirmPasswordError" class="error" style="color: red;"></span><br>
            </fieldset>
        </section>

        <section>
            <fieldset>
                <legend>Address Information</legend>
                <label>Address: <textarea name="Address"></textarea></label>
                <span id="addressError" class="error" style="color: red;"></span><br>
                
                <label>City/State/Country: <input type="text" name="CityStateCountry"></label>
                <span id="cityStateCountryError" class="error" style="color: red;"></span><br>
            </fieldset>
        </section>

        <section>
            <fieldset>
                <legend>Preferences</legend>

                <div class="preference-item">
                    <label>Enable Location Services:</label>
                    <input type="radio" name="Location" value="Yes"> Yes
                    <input type="radio" name="Location" value="No"> No
                    <span id="locationError" class="error"></span><br>
                </div>

                <div class="preference-item">
                    <label>Adoption Notifications:</label>
                    <input type="radio" name="AdoptionNotifications" value="Yes"> Yes
                    <input type="radio" name="AdoptionNotifications" value="No"> No
                    <span id="adoptionNotificationsError" class="error"></span><br>
                </div>

                <div class="preference-item">
                    <label>Donation Campaigns:</label>
                    <input type="radio" name="DonationCampaigns" value="Yes"> Yes
                    <input type="radio" name="DonationCampaigns" value="No"> No
                    <span id="donationCampaignsError" class="error"></span><br>
                </div>

                <div class="preference-item">
                    <label>Newsletter Subscription:</label>
                    <input type="radio" name="NewsletterSubscription" value="Yes"> Yes
                    <input type="radio" name="NewsletterSubscription" value="No"> No
                    <span id="newsletterSubscriptionError" class="error"></span><br>
                </div>

            </fieldset>
        </section>


        <section>
            <fieldset>
                <legend>Profile Picture</legend>
                <label>Upload Profile Picture: <input type="file" name="ProfilePicture" accept="image/*"></label>
                <span id="profilePictureError" class="error" style="color: red;"></span><br>
            </fieldset>
        </section>

        <section>
            <fieldset>
                <legend>Social Media Links</legend>
                <label>Social Media: <input type="text" name="SocialMediaLinks"></label>
            </fieldset>
        </section>

        <section>
            <fieldset>
                <legend>Verification</legend>
                <label>
                    <input type="checkbox" name="EmailVerification" value="Verified"> Confirm Email Verification
                </label>
                <span id="emailVerificationError" class="error" style="color: red;"></span><br>
            </fieldset>
        </section>

        <section>
            <button type="submit" name="register">Submit</button>
        </section>
    </form>
    </section>


    <footer>
        <p>&copy; 2024 PawsitiveWellbeing. All rights reserved.</p>
    </footer>

    <script src="../js/FormValidation.js"></script>    

</body>
</html>
