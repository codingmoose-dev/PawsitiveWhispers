<?php
require_once '../control/reg_control.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();
    $result = $userController->register($_POST, $_FILES);

    echo $result; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Care and Pet Adoption Platform - Registration Form</title>
</head>
<body>
    <h1>Animal Care and Pet Adoption Platform - Registration Form</h1>
    <form name="registrationForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <!-- Basic Information Fields -->
        <fieldset>
            <legend>Basic Information</legend>
            <table>
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="FullName"><span id="fullNameError" class="error" style="color: red;"></span></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="Email"><span id="emailError" class="error" style="color: red;"></span></td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td><input type="text" name="Phone"><span id="phoneError" class="error" style="color: red;"></span></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="Password"><span id="passwordError" class="error" style="color: red;"></span></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="ConfirmPassword"><span id="confirmPasswordError" class="error" style="color: red;"></span></td>
                </tr>
            </table>
        </fieldset>

        <!-- Address Information -->
        <fieldset>
            <legend>Address Information</legend>
            <table>
                <tr>
                    <td>Address:</td>
                    <td><textarea name="Address"></textarea><span id="addressError" class="error" style="color: red;"></span></td>
                </tr>
                <tr>
                    <td>City/State/Country:</td>
                    <td><input type="text" name="CityStateCountry"><span id="cityStateCountryError" class="error" style="color: red;"></span></td>
                </tr>
            </table>
        </fieldset>

        <!-- Preferences -->
        <fieldset>
            <legend>Preferences</legend>
            <table>
                <tr>
                    <td>Enable Location Services:</td>
                    <td>
                        <input type="radio" name="Location" value="Yes"> Yes
                        <input type="radio" name="Location" value="No"> No
                        <span id="locationError" class="error" style="color: red;"></span>
                    </td>
                </tr>
                <tr>
                    <td>Adoption Notifications:</td>
                    <td>
                        <input type="radio" name="AdoptionNotifications" value="Yes"> Yes
                        <input type="radio" name="AdoptionNotifications" value="No"> No
                        <span id="adoptionNotificationsError" class="error" style="color: red;"></span>
                    </td>
                </tr>
                <tr>
                    <td>Donation Campaigns:</td>
                    <td>
                        <input type="radio" name="DonationCampaigns" value="Yes"> Yes
                        <input type="radio" name="DonationCampaigns" value="No"> No
                        <span id="donationCampaignsError" class="error" style="color: red;"></span>
                    </td>
                </tr>
                <tr>
                    <td>Newsletter Subscription:</td>
                    <td>
                        <input type="radio" name="NewsletterSubscription" value="Yes"> Yes
                        <input type="radio" name="NewsletterSubscription" value="No"> No
                        <span id="newsletterSubscriptionError" class="error" style="color: red;"></span>
                    </td>
                </tr>
            </table>
        </fieldset>

        <!-- Profile Picture (Upload Image File) -->
        <fieldset>
            <legend>Profile Picture</legend>
            <table>
                <tr>
                    <td>Upload Profile Picture:</td>
                    <td>
                        <input type="file" name="ProfilePicture" accept="image/*">
                        <span id="profilePictureError" class="error" style="color: red;"></span>
                    </td>
                </tr>
            </table>
        </fieldset>

        <!-- Social Media Links -->
        <fieldset>
            <legend>Social Media Links</legend>
            <table>
                <tr>
                    <td>Social Media:</td>
                    <td><input type="text" name="SocialMediaLinks"></td>
                </tr>
                <tr>
            </table>
        </fieldset>

        <!-- Verification -->
        <fieldset>
            <legend>Verification</legend>
            <table>
                <tr>
                    <td>Email Verification:</td>
                    <td><input type="checkbox" name="EmailVerification" value="Verified"> Confirm Email Verification</td>
                    <span id="emailVerificationError" class="error" style="color: red;"></span>

                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" value="Register">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>
</html>
