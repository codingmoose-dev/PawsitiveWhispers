<?php
// Include the necessary files
include '../model/usermodel.php'; // Ensure the path is correct

// Fetch all users
$userModel = new UserModel();
$users = $userModel->getAllUsers();

// Check if the delete form has been submitted
if (isset($_POST['delete_user_id'])) {
    $userIdToDelete = $_POST['delete_user_id'];
    // Delete the user by ID
    if ($userModel->deleteUser($userIdToDelete)) {
        echo "<p>User with ID $userIdToDelete has been deleted successfully.</p>";
        // Refresh the user list
        $users = $userModel->getAllUsers();
    } else {
        echo "<p>Error deleting user with ID $userIdToDelete.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
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
    </style>
</head>
<body>
    <h1>Registered Benefactors</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Password</th>
                <th>Address</th>
                <th>Organization Type</th>
                <th>Donation Type</th>
                <th>Preferred Campaign</th>
                <th>Payment Method</th>
                <th>Save Payment Info</th>
                <th>Willing to Sponsor</th>
                <th>Interested in Partnership</th>
                <th>Captcha</th>
                <th>Terms & Conditions</th>
                <th>Email Verified</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)) { ?>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']); ?></td>
                        <td><?= htmlspecialchars($user['full_name']); ?></td>
                        <td><?= htmlspecialchars($user['email']); ?></td>
                        <td><?= htmlspecialchars($user['phone']); ?></td>
                        <td><?= htmlspecialchars($user['password']); ?></td>
                        <td><?= htmlspecialchars($user['address']); ?></td>
                        <td><?= htmlspecialchars($user['organization_type']); ?></td>
                        <td><?= htmlspecialchars($user['donation_type']); ?></td>
                        <td><?= htmlspecialchars($user['preferred_campaign']); ?></td>
                        <td><?= htmlspecialchars($user['payment_method']); ?></td>
                        <td><?= htmlspecialchars($user['save_payment_info']); ?></td>
                        <td><?= htmlspecialchars($user['willing_to_sponsor']); ?></td>
                        <td><?= htmlspecialchars($user['interested_in_partnership']); ?></td>
                        <td><?= htmlspecialchars($user['captcha']); ?></td>
                        <td><?= htmlspecialchars($user['terms_conditions']); ?></td>
                        <td><?= htmlspecialchars($user['email_verified']); ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="16">No users found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2>Delete User</h2>
    <form method="POST" action="">
        <label for="delete_user_id">Enter User ID to delete:</label>
        <input type="number" name="delete_user_id" id="delete_user_id" required>
        <button type="submit">Delete User</button>
    </form>
</body>
</html>
