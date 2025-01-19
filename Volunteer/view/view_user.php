<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Volunteers of PawsitiveWellbeing</title>
</head>
<body>
    <h1>All Volunteers of PawsitiveWellbeing</h1>

    <?php if (isset($_GET['success']) && $_GET['success'] === 'update'): ?>
        <p style="color: green;">User information updated successfully!</p>
    <?php elseif (isset($_GET['error'])): ?>
        <p style="color: red;">Error updating user information!</p>
    <?php endif; ?>

    <?php if (empty($users)): ?>
        <p>No volunteers found.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>Volunteer ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Home Address</th>
                <th>City/State/Country</th>
                <th>Location Enabled</th>
                <th>Emergency Rescue</th>
                <th>Organize Campaigns</th>
                <th>Manage Adoption</th>
                <th>Skills</th>
                <th>Experience Years</th>
                <th>Availability</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['VolunteerID']) ?></td>
                    <td><?= htmlspecialchars($user['FullName']) ?></td>
                    <td><?= htmlspecialchars($user['Email']) ?></td>
                    <td><?= htmlspecialchars($user['Phone']) ?></td>
                    <td><?= htmlspecialchars($user['HomeAddress']) ?></td>
                    <td><?= htmlspecialchars($user['CityStateCountry']) ?></td>
                    <td><?= htmlspecialchars($user['LocationEnabled']) ?></td>
                    <td><?= htmlspecialchars($user['EmergencyRescue']) ?></td>
                    <td><?= htmlspecialchars($user['OrganizeCampaigns']) ?></td>
                    <td><?= htmlspecialchars($user['ManageAdoption']) ?></td>
                    <td><?= htmlspecialchars($user['Skills']) ?></td>
                    <td><?= htmlspecialchars($user['ExperienceYears']) ?></td>
                    <td><?= htmlspecialchars($user['Availability']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <h2>Update User Information</h2>
    <form action="view_user.php" method="post">
        <input type="hidden" name="action" value="update">
        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" required><br><br>

        <label for="FullName">Full Name:</label>
        <input type="text" id="FullName" name="FullName" required><br><br>

        <label for="Email">Email:</label>
        <input type="email" id="Email" name="Email" required><br><br>

        <label for="Phone">Phone:</label>
        <input type="text" id="Phone" name="Phone"><br><br>

        <label for="Password">Password:</label>
        <input type="password" id="Password" name="Password"><br><br>

        <label for="HomeAddress">Home Address:</label>
        <input type="text" id="HomeAddress" name="HomeAddress" required><br><br>

        <label for="CityStateCountry">City/State/Country:</label>
        <input type="text" id="CityStateCountry" name="CityStateCountry" required><br><br>

        <label for="LocationEnabled">Location Enabled:</label>
        <input type="checkbox" id="LocationEnabled" name="LocationEnabled"><br><br>

        <label for="EmergencyRescue">Emergency Rescue:</label>
        <input type="checkbox" id="EmergencyRescue" name="EmergencyRescue"><br><br>

        <label for="OrganizeCampaigns">Organize Campaigns:</label>
        <input type="checkbox" id="OrganizeCampaigns" name="OrganizeCampaigns"><br><br>

        <label for="ManageAdoption">Manage Adoption:</label>
        <input type="checkbox" id="ManageAdoption" name="ManageAdoption"><br><br>

        <label for="Skills">Skills:</label>
        <input type="text" id="Skills" name="Skills" required><br><br>

        <label for="ExperienceYears">Experience Years:</label>
        <input type="number" id="ExperienceYears" name="ExperienceYears" required><br><br>

        <label for="Availability">Availability:</label>
        <input type="text" id="Availability" name="Availability" required><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
