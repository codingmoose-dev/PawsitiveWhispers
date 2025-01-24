<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Animal Care Benefactor Registration</title>
    <script src="../js/FormValidation.js"></script>
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
        <form action="" method="post" onsubmit="return validateForm()">
            <!-- Personal Information -->
            <fieldset>
                <legend>Personal Information</legend>
                <div class="form-grid">
                    <label for="fname">Full Name (or Organization Name):</label>
                    <input type="text" id="fname" name="fname" placeholder="David Carter | Paws NGO" required>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="davidcarter@email.com" required>
                    
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" placeholder="+1 234-567-8901" required>
                    
                    <label for="pwd">Password:</label>
                    <input type="password" id="pwd" name="pwd" required>
                    
                    <label for="cpwd">Confirm Password:</label>
                    <input type="password" id="cpwd" name="cpwd" required>
                </div>
            </fieldset>

            <!-- Address Information -->
            <fieldset>
                <legend>Address Information</legend>
                <div class="form-grid">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" rows="3" placeholder="1234 Main St, City, Country" required></textarea>
                </div>
            </fieldset>

            <!-- Organization Type -->
            <fieldset>
                <legend>Organization Type</legend>
                <div>
                    <input type="radio" id="IndividualDonor" name="otype" value="IndividualDonor" >
                    <label for="IndividualDonor">Individual Donor</label>

                    <input type="radio" id="CorporateSponsor" name="otype" value="CorporateSponsor">
                    <label for="CorporateSponsor">Corporate Sponsor</label>

                    <input type="radio" id="ngopartner" name="otype" value="NgoPartner">
                    <label for="ngopartner">NGO Partner</label>
                </div>
            </fieldset>


            <!-- Donation Preferences -->
            <fieldset>
                <legend>Donation Preferences</legend>
                <div class="form-grid">
                    <label>Preferred Donation Type:</label>
                    <div>
                        <input type="radio" id="onetime" name="donationtype" value="One-time Donations" required>
                        <label for="onetime">One-time Donations</label>
                        <input type="radio" id="MonthlySubscription" name="donationtype" value="Monthly Subscription">
                        <label for="MonthlySubscription">Monthly Subscription</label>
                    </div>

                    <label for="campaign">Preferred Campaign:</label>
                    <input id="campaignInput" list="campaign" name="campaign">
                    <datalist id="campaign">
                        <option value="Emergency Rescue">
                        <option value="Veterinary Care">
                        <option value="Shelter Support">
                        <option value="Other">
                    </datalist>
                </div>
            </fieldset>
            
        <!-- Volunteer Information -->
        <fieldset>
            <legend>Volunteer Information</legend>
            <div class="form-grid">
                <label for="volunteerRole">Preferred Volunteer Role:</label>
                <select id="volunteerRole" name="volunteerRole" required>
                    <option value="Animal Care">Animal Care</option>
                    <option value="Event Management">Event Management</option>
                    <option value="Fundraising">Fundraising</option>
                    <option value="Other">Other</option>
                </select>

                <label for="availability">Availability (Days/Hours):</label>
                <input type="text" id="availability" name="availability" placeholder="e.g., Weekends, 4-6 hours" required>
            </div>
        </fieldset>

        <!-- Payment Information -->
        <fieldset>
            <legend>Payment Information</legend>
            <div class="form-grid">
                <label>Payment Method:</label>
                <div>
                    <input type="radio" id="credit-card" name="payment-method" value="credit-card" required> Credit Card
                    <input type="radio" id="paypal" name="payment-method" value="paypal"> PayPal
                    <input type="radio" id="other" name="payment-method" value="other"> Other
                </div>

                <label>Save Payment Info for Future Donations:</label>
                <div>
                    <input type="radio" id="save-yes" name="save-payment" value="yes" required> Yes
                    <input type="radio" id="save-no" name="save-payment" value="no"> No
                </div>
            </div>
        </fieldset>

        <!-- Sponsorship Option -->
        <fieldset>
            <legend>Sponsorship Option (Optional)</legend>
            <div class="form-grid">
                <label>Willing to Sponsor Events:</label>
                <div>
                    <input type="radio" id="sponsor-yes" name="sponsor-events" value="yes"> Yes
                    <input type="radio" id="sponsor-no" name="sponsor-events" value="no"> No
                </div>

                <label>Interested in NGO Partnership:</label>
                <div>
                    <input type="radio" id="ngo-yes" name="ngo-partnership" value="yes"> Yes
                    <input type="radio" id="ngo-no" name="ngo-partnership" value="no"> No
                </div>
            </div>
        </fieldset>

        <!-- Security -->
        <fieldset>
            <legend>Security</legend>
            <div class="form-grid">
                <label for="captcha">Captcha Verification:</label>
                <input type="text" id="captcha" name="captcha" placeholder="Enter Captcha" required>

                <label for="terms-conditions">Terms & Conditions:</label>
                <div>
                    <input type="checkbox" id="terms-conditions" name="terms-conditions" value="agree" required> I agree to the Terms & Conditions and Privacy Policy
                </div>
            </div>
        </fieldset>

        <!-- Confirmation -->
        <fieldset>
        <legend>Confirmation</legend>
            <div class="form-grid">
                <label for="email-verification">Email Verification:</label>
                <div>
                    <input type="checkbox" id="email-verification" name="email-verification" value="verified" required> I confirm my email verification
                </div>
            </div>
        </fieldset>


        <!-- Additional Notes -->
        <fieldset>
            <legend>Additional Notes</legend>
            <div class="form-grid">
                <label for="notes">Comments or Special Instructions:</label>
                <textarea id="notes" name="notes" rows="4" placeholder="Let us know if you have any specific preferences or concerns."></textarea>
            </div>
        </fieldset>


            <button type="submit">Submit</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2025 PawsitiveWellbeing. All rights reserved.</p>
    </footer>
</body>
</html>