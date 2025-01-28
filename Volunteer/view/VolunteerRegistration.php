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
                    <td><label for="full_name">Full Name:</label></td>
                    <td><input type="text" id="full_name" name="full_name" placeholder="Your full name" ></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" placeholder="email@example.com" ></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone:</label></td>
                    <td><input type="tel" id="phone" name="phone" placeholder="123-456-789" ></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" ></td>
                </tr>
                <tr>
                    <td><label for="confirm_password">Confirm Password:</label></td>
                    <td><input type="password" id="confirm_password" name="confirm_password" ></td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend>Location</legend>
            <table>
                <tr>
                    <td><label for="home_address">Home Address:</label></td>
                    <td><input type="text" id="home_address" name="home_address" ></td>
                </tr>
                <tr>
                    <td><label for="city_state_country">City/State/Country:</label></td>
                    <td><input type="text" id="city_state_country" name="city_state_country" ></td>
                </tr>
                <tr>
                    <td>Enable Location Services:</td>
                    <td>
                        <input type="radio" id="location-yes" name="location_enabled" value="Yes" >
                        <label for="location-yes">Yes</label>
                        <input type="radio" id="location-no" name="location_enabled" value="No">
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
                        <input type="radio" id="emergency-yes" name="emergency_rescue" value="yes" >
                        <label for="emergency-yes">Yes</label>
                        <input type="radio" id="emergency-no" name="emergency_rescue" value="no">
                        <label for="emergency-no">No</label>
                    </td>
                </tr>
                <tr>
                    <td>Willing to Organize Campaigns:</td>
                    <td>
                        <input type="radio" id="organize-yes" name="organize_campaigns" value="yes" >
                        <label for="organize-yes">Yes</label>
                        <input type="radio" id="organize-no" name="organize_campaigns" value="no">
                        <label for="organize-no">No</label>
                    </td>
                </tr>
                <tr>
                    <td>Willing to Manage Adoption Approvals:</td>
                    <td>
                        <input type="radio" id="adoption-yes" name="manage_adoption" value="yes" >
                        <label for="adoption-yes">Yes</label>
                        <input type="radio" id="adoption-no" name="manage_adoption" value="no">
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
                        <select id="skills" name="skills" >
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
                    <td><label for="experience_years">Years of Experience:</label></td>
                    <td>
                        <input type="number" id="experience_years" name="experience_years" min="0" step="1" placeholder="Enter years of experience" >
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
                        <select id="availability" name="availability" >
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
