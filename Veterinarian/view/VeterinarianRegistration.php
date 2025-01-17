<!DOCTYPE html>
<html >
<head>
  
    <title>Registration</title>
</head>
<body>
<form method="POST" action="reg_control.php">
<fieldset>
            <legend>Personal Information</legend>
            <table>
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" id="username" name="username" ></td> 
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><input type="email" id="email" name="email" placeholder="email@example.com"></td> 
                </tr>
                <tr>
                    <td>Phone: </td>
                    <td>  <input type="tel" id="phone" name="phone" placeholder="123-456-7890"
                    pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required></td> 
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" id="password" name="password"></td> 
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" id="password" name="password"></td> 
                </tr>
</table>
</fieldset>
        <fieldset>
            <legend>Location</legend>
          
           
            <table>
                <tr>
                <td>Clinic Address: </td>
                <td><textarea name-="adress"></textarea></td> 
                </tr>
                <tr>
                <td>Enable Location service: </td>
                <td><input type="radio" name-="adress" value="yes" >Yes
                <input type="radio" name-="adress" value="no" >No</td> 
                </tr>


</table>

</fieldset>

<fieldset>
        <legend>Professional Information</legend>
        <table>
        <tr>
                  
                    <td>Medical Lisecnce Number: </td>
                    <td><input type="number" id="lisence" name="lisence" ></td> 
                </tr>
                <tr>
                    <td>Clinic Name: </td>
                    <td><input type="text" id="clinicname" name="clinicname" ></td> 
                </tr>
                <tr>
                <td>Speciality: </td>
                <td><select id="speciality" name="speciality">
            <option value=""selected disabled>select speciality</option>
            <option value="Surgery">Surgery</option>
            <option value="general practice">General Practice</option>
            
                   </select>
                </td></tr>
        </table>

        </fieldset>
        <fieldset>
        <legend>Services</legend>
        <table>
            <tr>
                <td>Select Offered Services:</td>
                <td>
                    <select id="services" name="services" required>
                        <option value="" selected disabled>Select a Service</option>
                        <option value="emergency_care">Emergency Care</option>
                        <option value="surgery">Surgery</option>
                        <option value="vaccinations">Vaccinations</option>
                        <option value="other">Other</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Availability Schedule:</td>
                <td><input type="text" id="working_hours" name="working_hours" placeholder="e.g., Mon-Fri, 9am-5pm" required></td>
            </tr>
        </table>
    </fieldset>

    
    <fieldset>
        <legend>Upload Verification Documents</legend>
        <table>
            <tr>
                <td>Veterinary or Medical License:</td>
                <td><input type="file" id="vet_license" name="vet_license" accept=".pdf, .jpg, .jpeg, .png" required></td>
            </tr>
            <tr>
                <td>Government-issued ID:</td>
                <td><input type="file" id="gov_id" name="gov_id" accept=".pdf, .jpg, .jpeg, .png" required></td>
            </tr>
        </table>
    </fieldset>


    <fieldset>
        <legend>Training (Optional)</legend>
        <table>
            <tr>
                <td>Upload or Manage Training Materials:</td>
                <td><input type="file" id="training_materials" name="training_materials" accept=".pdf, .doc, .docx"></td>
            </tr>
            <tr>
                <td>Opt-in to Host Training Sessions:</td>
                <td>
                    <input type="radio" id="host_training_yes" name="host_training" value="yes"> Yes
                    <input type="radio" id="host_training_no" name="host_training" value="no"> No
                </td>
            </tr>
        </table>
    </fieldset>


    <table>
    <tr><td><button type="submit">Submit</button></td></tr>
</table>

</form>
        
</body>
</html>