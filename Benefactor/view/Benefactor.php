<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Care Benefactor Registration</title>
</head>
<body>
    <h1>Register Yourself as an Animal Care Benefactor!</h1>
    <p>For individuals, businesses, or organizations who financially support rescue operations, campaigns, and animal care.</p>

    <form action="reg_control.php" method="post"> 
        <!-- Personal Information -->
        <fieldset>
            <legend>Personal Information</legend>
            <table>
                <tr>
                    <td><label for="fname">Full Name (or Organization Name):</label></td>
                    <td><input type="text" id="fname" name="fname" placeholder="David Carter | Paws NGO" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" placeholder="davidcarter@email.com" required></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone:</label></td>
                    <td><input type="tel" id="phone" name="phone" placeholder="+1 234-567-8901" required></td>
                </tr>
                <tr>
                    <td><label for="pwd">Password:</label></td>
                    <td><input type="password" id="pwd" name="pwd" required></td>
                </tr>
                <tr>
                    <td><label for="cpwd">Confirm Password:</label></td>
                    <td><input type="password" id="cpwd" name="cpwd" required></td>
                </tr>
            </table>
        </fieldset>

        <!-- Address Information -->
        <fieldset>
            <legend>Address Information</legend>
            <table>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><textarea id="address" name="address" rows="3" cols="30" placeholder="1234 Main St, City, Country" required></textarea></td>
                </tr>
            </table>
        </fieldset>

        <!-- Organization Type -->
        <fieldset>
            <legend>Organization Type</legend>
            <table>
                <tr>
                    <td><label>Type:</label></td>
                    <td>
                        <input type="radio" id="IndividualDonor" name="otype" value="IndividualDonor" required>
                        <label for="IndividualDonor">Individual Donor</label>
                        <input type="radio" id="CorporateSponsor" name="otype" value="CorporateSponsor">
                        <label for="CorporateSponsor">Corporate Sponsor</label>
                        <input type="radio" id="ngopartner" name="otype" value="NgoPartner">
                        <label for="ngopartner">NGO Partner</label>
                    </td>
                </tr>
            </table>
        </fieldset>

        <!-- Donation Preferences -->
        <fieldset>
            <legend>Donation Preferences</legend>
            <table>
                <tr>
                    <td><label>Preferred Donation Type:</label></td>
                    <td>
                        <input type="radio" id="onetime" name="donationtype" value="One-time Donations" required>
                        <label for="onetime">One-time Donations</label>
                        <input type="radio" id="MonthlySubscription" name="donationtype" value="Monthly Subscription">
                        <label for="MonthlySubscription">Monthly Subscription</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="campaign">Preferred Campaign:</label></td>
                    <td>
                        <input id="campaignInput" list="campaign" name="campaign">
                        <datalist id="campaign">
                            <option value="Emergency Rescue">
                            <option value="Veterinary Care">
                            <option value="Shelter Support">
                            <option value="Other">
                        </datalist>
                    </td>
                </tr>
            </table>
        </fieldset>

        <!-- Payment Information -->
        <fieldset>
            <legend>Payment Information</legend>
            <table>
                <tr>
                    <td><label>Payment Method:</label></td>
                    <td>
                        <input type="radio" id="credit-card" name="payment-method" value="credit-card" required> Credit Card
                        <input type="radio" id="paypal" name="payment-method" value="paypal"> PayPal
                        <input type="radio" id="other" name="payment-method" value="other"> Other
                    </td>
                </tr>
                <tr>
                    <td><label>Save Payment Info for Future Donations:</label></td>
                    <td>
                        <input type="radio" id="save-yes" name="save-payment" value="yes" required> Yes
                        <input type="radio" id="save-no" name="save-payment" value="no"> No
                    </td>
                </tr>
            </table>
        </fieldset>

        <!-- Sponsorship Option -->
        <fieldset>
            <legend>Sponsorship Option (Optional)</legend>
            <table>
                <tr>
                    <td><label>Willing to Sponsor Events:</label></td>
                    <td>
                        <input type="radio" id="sponsor-yes" name="sponsor-events" value="yes"> Yes
                        <input type="radio" id="sponsor-no" name="sponsor-events" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td><label>Interested in NGO Partnership:</label></td>
                    <td>
                        <input type="radio" id="ngo-yes" name="ngo-partnership" value="yes"> Yes
                        <input type="radio" id="ngo-no" name="ngo-partnership" value="no"> No
                    </td>
                </tr>
            </table>
        </fieldset>

        <!-- Security -->
        <fieldset>
            <legend>Security</legend>
            <table>
                <tr>
                    <td><label for="captcha">Captcha Verification:</label></td>
                    <td><input type="text" id="captcha" name="captcha" placeholder="Enter Captcha" required></td>
                </tr>
                <tr>
                    <td><label for="terms-conditions">Terms & Conditions:</label></td>
                    <td>
                        <input type="checkbox" id="terms-conditions" name="terms-conditions" value="agree" required> I agree to the Terms & Conditions and Privacy Policy
                    </td>
                </tr>
            </table>
        </fieldset>

        <!-- Confirmation -->
        <fieldset>
            <legend>Confirmation</legend>
            <table>
                <tr>
                    <td><label for="email-verification">Email Verification:</label></td>
                    <td>
                        <input type="checkbox" id="email-verification" name="email-verification" value="verified" required> I confirm my email verification
                    </td>
                </tr>
            </table>
        </fieldset>

        <!-- Submit Button -->
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>
</body>
</html>