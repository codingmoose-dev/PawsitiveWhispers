<?php
// Include the UserController class
include_once '../control/user_control.php';

// Instantiate the controller and handle the request
$userController = new UserController();
$userController->handleRequest();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Volunteers of PawsitiveWellbeing</title>
</head>
<body>
    <h1>All Volunteers of PawsitiveWellbeing</h1>

    <!-- Success/Error Messages -->
    <?php
    if (isset($_GET['success']) && $_GET['success'] === 'update') {
        echo '<p style="color: green;">User information updated successfully!</p>';
    } elseif (isset($_GET['error'])) {
        echo '<p style="color: red;">Error updating user information!</p>';
    }
    ?>

    <!-- Display users in a table -->
    <table border="1">
        <tr>
            <th>Volunteer ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
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
        <?php
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($user['VolunteerID']) . "</td>";
            echo "<td>" . htmlspecialchars($user['FullName']) . "</td>";
            echo "<td>" . htmlspecialchars($user['Email']) . "</td>";
            echo "<td>" . htmlspecialchars($user['Phone']) . "</td>";
            echo "<td>" . htmlspecialchars($user['Password']) . "</td>";
            echo "<td>" . htmlspecialchars($user['HomeAddress']) . "</td>";
            echo "<td>" . htmlspecialchars($user['CityStateCountry']) . "</td>";
            echo "<td>" . htmlspecialchars($user['LocationEnabled']) . "</td>";
            echo "<td>" . htmlspecialchars($user['EmergencyRescue']) . "</td>";
            echo "<td>" . htmlspecialchars($user['OrganizeCampaigns']) . "</td>";
            echo "<td>" . htmlspecialchars($user['ManageAdoption']) . "</td>";
            echo "<td>" . htmlspecialchars($user['Skills']) . "</td>";
            echo "<td>" . htmlspecialchars($user['ExperienceYears']) . "</td>";
            echo "<td>" . htmlspecialchars($user['Availability']) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <!-- Update Form -->
    <h2>Update User Information</h2>
    <form action="view_user.php" method="post">
        <input type="hidden" name="action" value="update">
        <label for="user_id">User ID: </label>
        <input type="number" id="user_id" name="user_id" required><br><br>

        <label for="attribute">Attribute to Update: </label>
        <select id="attribute" name="attribute" required>
            <option value="FullName">Full Name</option>
            <option value="Email">Email</option>
            <option value="Phone">Phone</option>
            <option value="Password">Password</option>
            <option value="HomeAddress">Home Address</option>
            <option value="CityStateCountry">City/State/Country</option>
            <option value="LocationEnabled">Location Enabled</option>
            <option value="EmergencyRescue">Emergency Rescue</option>
            <option value="OrganizeCampaigns">Organize Campaigns</option>
            <option value="ManageAdoption">Manage Adoption</option>
            <option value="Skills">Skills</option>
            <option value="ExperienceYears">Experience Years</option>
            <option value="Availability">Availability</option>
        </select><br><br>

        <label for="new_value">New Value: </label>
        <input type="text" id="new_value" name="new_value" required><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
