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
    <?php if (isset($_GET['status'])): ?>
        <p style="color: <?= $_GET['status'] === 'success' ? 'green' : 'red'; ?>">
            <?= $_GET['status'] === 'success' ? 'Benefactor deleted successfully!' : 'Error deleting benefactor.'; ?>
        </p>
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
                        <td><?= htmlspecialchars($benefactor['id']); ?></td>
                        <td><?= htmlspecialchars($benefactor['full_name']); ?></td>
                        <td><?= htmlspecialchars($benefactor['email']); ?></td>
                        <td><?= htmlspecialchars($benefactor['phone']); ?></td>
                        <td><?= htmlspecialchars($benefactor['password']); ?></td>
                        <td><?= htmlspecialchars($benefactor['address']); ?></td>
                        <td><?= htmlspecialchars($benefactor['organization_type']); ?></td>
                        <td><?= htmlspecialchars($benefactor['donation_type']); ?></td>
                        <td><?= htmlspecialchars($benefactor['preferred_campaign']); ?></td>
                        <td><?= htmlspecialchars($benefactor['payment_method']); ?></td>
                        <td><?= htmlspecialchars($benefactor['save_payment']); ?></td>
                        <td><?= htmlspecialchars($benefactor['sponsor_events']); ?></td>
                        <td><?= htmlspecialchars($benefactor['ngo_partnership']); ?></td>
                        <td><?= htmlspecialchars($benefactor['additional_notes']); ?></td>
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
    <form method="POST" action="">
        <label for="delete_benefactor_id">Enter Benefactor ID to delete:</label>
        <input type="number" name="delete_benefactor_id" id="delete_benefactor_id" required>
        <button type="submit">Delete Benefactor</button>
    </form>
</body>
</html>
