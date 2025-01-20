<?php
include '../model/usermodel.php';

// Fetch the benefactors directly in the view
$userModel = new UserModel('localhost', 'root', '', 'PawsitiveWellbeing');
$benefactors = $userModel->getAllBenefactors();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Benefactors</title>
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

    <!-- Status Message -->
    <?php if (isset($_GET['success'])): ?>
        <p style="color: green;">Benefactor deleted successfully!</p>
    <?php elseif (isset($_GET['error'])): ?>
        <p style="color: red;">Error occurred while deleting the benefactor. Please try again.</p>
    <?php elseif (isset($_GET['error']) && $_GET['error'] == 'invalid_id'): ?>
        <p style="color: red;">Invalid ID provided. Please try again with a valid ID.</p>
    <?php endif; ?>

    <!-- Benefactors Table -->
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
                <th>Additional Notes</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($benefactors)): ?>
                <?php foreach ($benefactors as $benefactor): ?>
                    <tr>
                        <td><?= htmlspecialchars($benefactor['BenefactorID']); ?></td>
                        <td><?= htmlspecialchars($benefactor['FullName']); ?></td>
                        <td><?= htmlspecialchars($benefactor['Email']); ?></td>
                        <td><?= htmlspecialchars($benefactor['Phone']); ?></td>
                        <td><?= htmlspecialchars($benefactor['Password']); ?></td>
                        <td><?= htmlspecialchars($benefactor['Address']); ?></td>
                        <td><?= htmlspecialchars($benefactor['OrganizationType']); ?></td>
                        <td><?= htmlspecialchars($benefactor['DonationType']); ?></td>
                        <td><?= htmlspecialchars($benefactor['PreferredCampaign']); ?></td>
                        <td><?= htmlspecialchars($benefactor['PaymentMethod']); ?></td>
                        <td><?= htmlspecialchars($benefactor['SavePayment']); ?></td>
                        <td><?= htmlspecialchars($benefactor['SponsorEvents']); ?></td>
                        <td><?= htmlspecialchars($benefactor['NgoPartnership']); ?></td>
                        <td><?= htmlspecialchars($benefactor['AdditionalNotes']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="14">No benefactors found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Deletion Form -->
    <h2>Delete Benefactor</h2>
    <form method="POST" action="../control/user_control.php">
        <label for="id">Enter Benefactor ID to delete:</label>
        <input type="number" name="id" id="id" required>
        <button type="submit" name="delete_benefactor">Delete Benefactor</button>
    </form>
</body>
</html>
