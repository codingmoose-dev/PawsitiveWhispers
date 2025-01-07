<!DOCTYPE html>
<html>
<head>
    <title>Volunteers & Specialists</title>
</head>
<body>
    <h1>Volunteers & Specialists</h1>

    <form action="../control/reg_control.php" method="post">
        <fieldset>
            <legend>Personal Information</legend>
            <table>
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><input type="text" name="email" placeholder="email@example.com"></td>
                </tr>
                <tr>
                    <td>Phone: </td>
                    <td><input type="text" name="phone" placeholder="123-456-789"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" name="confirm_password"></td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend>Location</legend>
            <table>
                <tr>
                    <td>Home Address: </td>
                    <td><input type="text" name="home_address"></td>
                </tr>
                <tr>
                    <td>City/State/Country: </td>
                    <td><input type="text" name="city_state_country"></td>
                </tr>
                <tr>
                    <td>Enable Location Services: </td>
                    <td>
                        <input type="radio" name="location" value="Yes">Yes
                        <input type="radio" name="location" value="No">No
                    </td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend>Volunteer Type Selection</legend>
            <table>
                <tr>
                    <td>Type (Choose one or more): </td>
                    <td>
                        <input type="checkbox" name="volunteer_type[]" value="Rescue Missions">Rescue Missions
                        <input type="checkbox" name="volunteer_type[]" value="Event/Campaign Organizer">Event/Campaign Organizer
                        <input type="checkbox" name="volunteer_type[]" value="Adoption Specialist">Adoption Specialist
                    </td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend>Experience Level</legend>
            <table>
                <tr>
                    <td>Experience Level:</td>
                    <td>
                        <select name="experience_level">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5+</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="skills">Relevant Skills:</label></td>
                    <td><input type="text" id="skills" name="skills"></td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend>Verification</legend>
            <table>
                <tr>
                    <td>Upload Government ID or Driver's License:</td>
                    <td><input type="file" id="id-upload" name="id_upload"></td>
                </tr>
                <tr>
                    <td>Emergency Contact (for Rescue Missions):</td>
                    <td><input type="text" id="emergency-contact" name="emergency_contact" placeholder="+880-12345678"></td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend>Training Certification (Optional)</legend>
            <table>
                <tr>
                    <td>Upload Volunteer Certifications (if applicable):</td>
                    <td><input type="file" id="certification-upload" name="certification_upload"></td>
                </tr>
                <tr>
                    <td>Not trained? Opt-in for training:</td>
                    <td><input type="checkbox" id="training-opt-in" name="training_opt_in" value="opt-in"> Yes, I would like to receive training.</td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend>Preferences</legend>
            <table>
                <tr>
                    <td>Available for Emergency Rescue Missions:</td>
                    <td>
                        <input type="radio" id="emergency-yes" name="emergency_missions" value="yes"> Yes
                        <input type="radio" id="emergency-no" name="emergency_missions" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Willing to Organize Campaigns:</td>
                    <td>
                        <input type="radio" id="organize-yes" name="organize_campaigns" value="yes"> Yes
                        <input type="radio" id="organize-no" name="organize_campaigns" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Willing to Manage Adoption Approvals:</td>
                    <td>
                        <input type="radio" id="adoption-yes" name="adoption_approval" value="yes"> Yes
                        <input type="radio" id="adoption-no" name="adoption_approval" value="no"> No
                    </td>
                </tr>
            </table>
        </fieldset>

        <table>
            <tr>
                <td><input type="submit" value="Submit"></td>
            </tr>
        </table>
    </form>
</body>
</html>
       