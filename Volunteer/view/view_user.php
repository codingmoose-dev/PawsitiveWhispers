<?php
require_once '../model/user_model.php'; // Adjust the path accordingly

$userModel = new UserModel(); // Instantiate UserModel
$connection = $userModel->getConnection();

// Handle the request to update user data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $userId = $_POST['user_id'];
    $fullName = $_POST['FullName'];
    $email = $_POST['Email'];
    $phone = $_POST['Phone'];
    $password = $_POST['Password'];
    $homeAddress = $_POST['HomeAddress'];
    $cityStateCountry = $_POST['CityStateCountry'];
    $locationEnabled = isset($_POST['LocationEnabled']) ? 1 : 0;
    $emergencyRescue = isset($_POST['EmergencyRescue']) ? 1 : 0;
    $organizeCampaigns = isset($_POST['OrganizeCampaigns']) ? 1 : 0;
    $manageAdoption = isset($_POST['ManageAdoption']) ? 1 : 0;
    $skills = $_POST['Skills'];
    $experienceYears = $_POST['ExperienceYears'];
    $availability = $_POST['Availability'];

    if ($userModel->updateVolunteer($userId, $fullName, $email, $phone, $password, $homeAddress, $cityStateCountry, 
                                    $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, 
                                    $experienceYears, $availability)) {
        header('Location: view_user.php?success=update');
        exit();
    } else {
        header('Location: view_user.php?error=true');
        exit();
    }
}

$volunteers = $userModel->getAllVolunteers(); // Fetch all volunteers from the database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Volunteers of PawsitiveWellbeing</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h1>All Volunteers of PawsitiveWellbeing</h1>

    <!-- Success or Error Message Section -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'update'): ?>
        <p style="color: green;">User information updated successfully!</p>
    <?php elseif (isset($_GET['error'])): ?>
        <p style="color: red;">Error updating user information!</p>
    <?php endif; ?>

    <table>
        <thead>
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
        </thead>
        <tbody>
            <?php while ($user = $volunteers->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($user['VolunteerID']) ?></td>
                <td><?= htmlspecialchars($user['FullName']) ?></td>
                <td><?= htmlspecialchars($user['Email']) ?></td>
                <td><?= htmlspecialchars($user['Phone']) ?></td>
                <td><?= htmlspecialchars($user['Password']) ?></td>
                <td><?= htmlspecialchars($user['HomeAddress']) ?></td>
                <td><?= htmlspecialchars($user['CityStateCountry']) ?></td>
                <td><?= $user['LocationEnabled'] == '1' ? 'Yes' : 'No' ?></td>
                <td><?= $user['EmergencyRescue'] == '1' ? 'Yes' : 'No' ?></td>
                <td><?= $user['OrganizeCampaigns'] == '1' ? 'Yes' : 'No' ?></td>
                <td><?= $user['ManageAdoption'] == '1' ? 'Yes' : 'No' ?></td>
                <td><?= htmlspecialchars($user['Skills']) ?></td>
                <td><?= htmlspecialchars($user['ExperienceYears']) ?></td>
                <td><?= htmlspecialchars($user['Availability']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h2>Update User Information</h2>
    <form action="view_user.php" method="post">
        <input type="hidden" name="action" value="update">
        <label for="user_id">User ID: </label><input type="text" id="user_id" name="user_id" required><br>
        <label for="FullName">Full Name: </label><input type="text" id="FullName" name="FullName" required><br>
        <label for="Email">Email: </label><input type="email" id="Email" name="Email" required><br>
        <label for="Phone">Phone: </label><input type="text" id="Phone" name="Phone" required><br>
        <label for="Password">Password: </label><input type="password" id="Password" name="Password" required><br>
        <label for="HomeAddress">Home Address: </label><input type="text" id="HomeAddress" name="HomeAddress" required><br>
        <label for="CityStateCountry">City, State, Country: </label><input type="text" id="CityStateCountry" name="CityStateCountry" required><br>
        <label for="LocationEnabled">Location Enabled: </label><input type="checkbox" id="LocationEnabled" name="LocationEnabled"><br>
        <label for="EmergencyRescue">Emergency Rescue: </label><input type="checkbox" id="EmergencyRescue" name="EmergencyRescue"><br>
        <label for="OrganizeCampaigns">Organize Campaigns: </label><input type="checkbox" id="OrganizeCampaigns" name="OrganizeCampaigns"><br>
        <label for="ManageAdoption">Manage Adoption: </label><input type="checkbox" id="ManageAdoption" name="ManageAdoption"><br>
        <label for="Skills">Skills: </label> <input type="text" id="Skills" name="Skills" value="<?= isset($user['Skills']) ? htmlspecialchars($user['Skills']) : '' ?>"><br>
        <label for="ExperienceYears">Experience Years: </label><input type="number" id="ExperienceYears" name="ExperienceYears" required><br>
        <label for="Availability">Availability: </label><input type="text" id="Availability" name="Availability" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>