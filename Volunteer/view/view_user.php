<?php
include '../model/user_model.php';
include '../control/user_control.php';

$model = new UserModel();

// Fetch all users
$users = $model->fetchUsersFromDatabase();
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Volunteers of PawsitiveWellbeing</title>
</head>
<body>
    <h1>All Volunteers of PawsitiveWellbeing</h1>

    <!-- Display the users in the table -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Home Address</th>
            <th>City/State/Country</th>
            <th>Location Services</th>
            <th>Volunteer Type</th>
            <th>Experience Level</th>
            <th>Skills</th>
            <th>Emergency Contact</th>
            <th>Emergency Missions</th>
            <th>Organize Campaigns</th>
            <th>Adoption Approval</th>
        </tr>
        <?php
        // Check if $users is an array and not empty
        if (isset($users) && is_array($users) && !empty($users)) {
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($user['id']) . "</td>";
                echo "<td>" . htmlspecialchars($user['full_name']) . "</td>";
                echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                echo "<td>" . htmlspecialchars($user['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($user['home_address']) . "</td>";
                echo "<td>" . htmlspecialchars($user['city_state_country']) . "</td>";
                echo "<td>" . htmlspecialchars($user['location_services']) . "</td>";
                echo "<td>" . htmlspecialchars($user['volunteer_type']) . "</td>";
                echo "<td>" . htmlspecialchars($user['experience_level']) . "</td>";
                echo "<td>" . htmlspecialchars($user['skills']) . "</td>";
                echo "<td>" . htmlspecialchars($user['emergency_contact']) . "</td>";
                echo "<td>" . htmlspecialchars($user['emergency_missions']) . "</td>";
                echo "<td>" . htmlspecialchars($user['organize_campaigns']) . "</td>";
                echo "<td>" . htmlspecialchars($user['adoption_approval']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo '<tr><td colspan="14">No volunteers found.</td></tr>';
        }
        ?>
    </table>

    <!-- New Update Section Below the Table -->
    <h2>Update User Information</h2>
    <form action="../control/user_control.php?action=update" method="post">
        <label for="user_id">User ID: </label>
        <input type="number" id="user_id" name="user_id" required><br><br>

        <label for="attribute">Attribute to Update: </label>
        <select id="attribute" name="attribute" required>
            <option value="full_name">Full Name</option>
            <option value="email">Email</option>
            <option value="phone">Phone</option>
            <option value="home_address">Home Address</option>
            <option value="city_state_country">City/State/Country</option>
            <option value="location_services">Location Services</option>
            <option value="volunteer_type">Volunteer Type</option>
            <option value="experience_level">Experience Level</option>
            <option value="skills">Skills</option>
            <option value="emergency_contact">Emergency Contact</option>
            <option value="emergency_missions">Emergency Missions</option>
            <option value="organize_campaigns">Organize Campaigns</option>
            <option value="adoption_approval">Adoption Approval</option>
        </select><br><br>

        <label for="new_value">New Value: </label>
        <input type="text" id="new_value" name="new_value" required><br><br>

        <input type="submit" value="Update">
    </form>

</body>
</html>
