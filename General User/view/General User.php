<!DOCTYPE html>
<html>
<head>   
    <title>Animal Care and Pet Adoption Platform</title>
</head>
<body>
<h1>Animal Care and Pet Adoption Platform</h1>
<form action="../control/reg_control.php" method="post">

    <fieldset>
        <legend>Basic Information</legend>

        <table>
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="FullName"></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="Email"></td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td><input type="number" name="Phone"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="Password"></td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td><input type="password" name="ConfirmPassword"></td>
            </tr>
        </table>
    </fieldset>

    <fieldset>
        <legend>Location</legend>

        <table>
            <tr>
                <td>Home Address:</td> 
                <td><input type="text" name="Address"></td>
            </tr>
            <tr>
                <td>City/State/Country:</td> 
                <td><input type="text" name="CityStateCountry"></td>
            </tr>
            <tr>
                <td>Enable Location Services:</td>
                <td>
                    <input type="radio" name="Location" value="Yes"> Yes 
                    <input type="radio" name="Location" value="No"> No
                </td>
            </tr>
        </table>
    </fieldset>

    <fieldset>
        <legend>Preferences</legend>

        <table>
            <tr> 
                <td>Opt-in for Adoption Notifications:</td>
                <td>
                    <input type="radio" name="AdoptionNotifications" value="Yes"> Yes 
                    <input type="radio" name="AdoptionNotifications" value="No"> No
                </td>
            </tr> 
            <tr> 
                <td>Opt-in for Donation Campaigns:</td>
                <td>
                    <input type="radio" name="DonationCampaigns" value="Yes"> Yes 
                    <input type="radio" name="DonationCampaigns" value="No"> No
                </td>
            </tr> 
        </table>  
    </fieldset>

    <fieldset>
        <legend>Optional Profile Details</legend>

        <table>
            <tr>
                <td>Profile Picture:</td>
                <td><input type="file" name="ProfilePicture" accept="image/*"></td>
            </tr>
            <tr>
                <td>Social Media Links:</td>
                <td><input type="text" name="SocialMediaLinks" placeholder="Facebook, Twitter"></td>
            </tr>
            <tr> 
                <td>Newsletter Subscription:</td>
                <td>
                    <input type="radio" name="NewsletterSubscription" value="Yes"> Yes 
                    <input type="radio" name="NewsletterSubscription" value="No"> No
                </td>
            </tr>
        </table>
    </fieldset>

    <fieldset>
        <legend>Confirmation</legend>

        <table>
            <tr>
                <td>Email Verification:</td>
                <td><input type="checkbox" name="EmailVerification" value="Verified"> I confirm my email verification</td>
            </tr>
        </table>
    </fieldset>
        
    <fieldset>
        <input type="submit" name="Submit" value="Submit">
        <input type="reset" name="ClearForm" value="Clear Form">
    </fieldset>

</form>
</body>
</html>