<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteers & Specialists</title>
</head>
<body>
    <h1>Volunteers & Specialists</h1>

    <form action="../control/reg_control.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">

        <fieldset>
            <legend>Personal Information</legend>
            <table>
                <tr>
                    <td><label for="name">Full Name:</label></td>
                    <td><input type="text" id="name" name="name" placeholder="Your full name" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" placeholder="email@example.com" required></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone:</label></td>
                    <td><input type="tel" id="phone" name="phone" placeholder="123-456-789" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" required></td>
                </tr>
                <tr>
                    <td><label for="confirm_password">Confirm Password:</label></td>
                    <td><input type="password" id="confirm_password" name="confirm_password" required></td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend>Location</legend>
            <table>
                <tr>
                    <td><label for="home_address">Home Address:</label></td>
                    <td><input type="text" id="home_address" name="home_address" required></td>
                </tr>
                <tr>
                    <td><label for="city_state_country">City/State/Country:</label></td>
                    <td><input type="text" id="city_state_country" name="city_state_country" required></td>
                </tr>
                <tr>
                    <td>Enable Location Services:</td>
                    <td>
                        <input type="radio" id="location-yes" name="location" value="Yes" required>
                        <label for="location-yes">Yes</label>
                        <input type="radio" id="location-no" name="location" value="No">
                        <label for="location-no">No</label>
                    </td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend>Preferences</legend>
            <table>
                <tr>
                    <td>Available for Emergency Rescue Missions:</td>
                    <td>
                        <input type="radio" id="emergency-yes" name="emergency_missions" value="yes" required>
                        <label for="emergency-yes">Yes</label>
                        <input type="radio" id="emergency-no" name="emergency_missions" value="no">
                        <label for="emergency-no">No</label>
                    </td>
                </tr>
                <tr>
                    <td>Willing to Organize Campaigns:</td>
                    <td>
                        <input type="radio" id="organize-yes" name="organize_campaigns" value="yes" required>
                        <label for="organize-yes">Yes</label>
                        <input type="radio" id="organize-no" name="organize_campaigns" value="no">
                        <label for="organize-no">No</label>
                    </td>
                </tr>
                <tr>
                    <td>Willing to Manage Adoption Approvals:</td>
                    <td>
                        <input type="radio" id="adoption-yes" name="adoption_approval" value="yes" required>
                        <label for="adoption-yes">Yes</label>
                        <input type="radio" id="adoption-no" name="adoption_approval" value="no">
                        <label for="adoption-no">No</label>
                    </td>
                </tr>
            </table>
        </fieldset>
        
        <fieldset>
            <legend>Skills and Experience</legend>
            <table>
                <tr>
                    <td><label for="skills">Skills:</label></td>
                    <td>
                        <select id="skills" name="skills" required>
                            <option value="Animal Handling">Animal Handling</option>
                            <option value="First Aid for Animals">First Aid for Animals</option>
                            <option value="Driving">Driving (for transporting animals)</option>
                            <option value="Event Planning">Event Planning</option>
                            <option value="Social Media Management">Social Media Management</option>
                            <option value="Veterinary Assistance">Veterinary Assistance (if not a licensed veterinarian)</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="experience">Years of Experience:</label></td>
                    <td>
                        <input type="number" id="experience" name="experience" min="0" step="1" placeholder="Enter years of experience" required>
                    </td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend>Availability</legend>
            <table>
                <tr>
                    <td><label for="availability">What is the best time for you to volunteer in rescue missions?</label></td>
                    <td>
                        <select id="availability" name="availability" required>
                            <option value="Weekends">Weekends</option>
                            <option value="Weekdays">Weekdays</option>
                            <option value="Morning">Morning</option>
                            <option value="Afternoon">Afternoon</option>
                            <option value="Evening">Evening</option>
                            <option value="Anytime">Anytime</option>
                        </select>
                    </td>
                </tr>
            </table>
        </fieldset>

        <div class="button">
            <input type="submit" value="Submit">
        </div>
    </form>
</body>
</html>
