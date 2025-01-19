<?php
// Increase memory limit at the start of the script
ini_set('memory_limit', '5G');  // Ensure 1GB memory limit is available

include_once '../control/user_control.php'; // Path to your UserController class
$controller = new UserController();
$controller->handleRequest();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Volunteers of PawsitiveWellbeing</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .pagination {
            margin-top: 20px;
        }
        .pagination a {
            padding: 8px 16px;
            margin: 0 4px;
            text-decoration: none;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>All Volunteers of PawsitiveWellbeing</h1>

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
        <?php 
        $limit = 10;  // Number of users per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Debugging: Check memory before and after each data fetch
        echo "Memory before fetching data: " . memory_get_usage() . " bytes\n";

        // Optimize: Only select necessary columns and limit data
        $userQuery = "SELECT VolunteerID, FullName, Email, Phone, HomeAddress, CityStateCountry, LocationEnabled, 
                        EmergencyRescue, OrganizeCampaigns, ManageAdoption, Skills, ExperienceYears, Availability
                      FROM Volunteers LIMIT $limit OFFSET $offset";
        
        // Execute query and check for errors
        $result = $userModel->getConnection()->query($userQuery);
        
        if ($result) {
            while ($user = $result->fetch_assoc()):
        ?>
            <tr>
                <td><?= htmlspecialchars($user['VolunteerID']) ?></td>
                <td><?= htmlspecialchars($user['FullName']) ?></td>
                <td><?= htmlspecialchars($user['Email']) ?></td>
                <td><?= htmlspecialchars($user['Phone']) ?></td>
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
        <?php
            endwhile;
        } else {
            echo "Error fetching users: " . $userModel->getConnection()->error;
        }

        // Debugging: Memory usage after fetching data
        echo "Memory after fetching data: " . memory_get_usage() . " bytes\n";

        // Free memory if needed (optional)
        // unset($user);
        // gc_collect_cycles();  // Force garbage collection to free up memory if needed
        ?>
    </tbody>
</table>

<?php
// Get total number of records for pagination
$totalUsersQuery = "SELECT COUNT(*) FROM Volunteers";
$result = $userModel->getConnection()->query($totalUsersQuery);
$totalUsers = $result->fetch_row()[0];
$totalPages = ceil($totalUsers / $limit);
?>

<div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>" <?= $i === $page ? 'style="font-weight: bold;"' : '' ?>><?= $i ?></a>
    <?php endfor; ?>
</div>

<h2>Update User Information</h2>
<form action="view_user.php" method="post">
    <input type="hidden" name="action" value="update">
    <label for="user_id">User ID: </label><input type="text" id="user_id" name="user_id"><br>
    <label for="FullName">Full Name: </label><input type="text" id="FullName" name="FullName"><br>
    <label for="Email">Email: </label><input type="email" id="Email" name="Email"><br>
    <label for="Phone">Phone: </label><input type="text" id="Phone" name="Phone"><br>
    <label for="Password">Password: </label><input type="password" id="Password" name="Password"><br>
    <label for="HomeAddress">Home Address: </label><input type="text" id="HomeAddress" name="HomeAddress"><br>
    <label for="CityStateCountry">City, State, Country: </label><input type="text" id="CityStateCountry" name="CityStateCountry"><br>
    <label for="LocationEnabled">Location Enabled: </label><input type="checkbox" id="LocationEnabled" name="LocationEnabled"><br>
    <label for="EmergencyRescue">Emergency Rescue: </label><input type="checkbox" id="EmergencyRescue" name="EmergencyRescue"><br>
    <label for="OrganizeCampaigns">Organize Campaigns: </label><input type="checkbox" id="OrganizeCampaigns" name="OrganizeCampaigns"><br>
    <label for="ManageAdoption">Manage Adoption: </label><input type="checkbox" id="ManageAdoption" name="ManageAdoption"><br>
    <label for="Skills">Skills: </label><input type="text" id="Skills" name="Skills"><br>
    <label for="ExperienceYears">Experience Years: </label><input type="text" id="ExperienceYears" name="ExperienceYears"><br>
    <label for="Availability">Availability: </label><input type="text" id="Availability" name="Availability"><br>
    <input type="submit" value="Update">
</form>
</body>
</html>
