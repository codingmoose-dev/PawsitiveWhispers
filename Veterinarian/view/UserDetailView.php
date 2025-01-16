<!DOCTYPE html>
<html>
<head>
    <title>Users Management</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Users Management</h1>

    <!-- List of All Users -->
    <h2>All Users</h2>
    <?php if (!empty($users)): ?>
        <ul>
            <?php foreach ($users as $user): ?>
                <li>
                    <?= htmlspecialchars($user['id']) ?>: 
                    <?= htmlspecialchars($user['username']) ?> 
                    (<a href="UserController.php?action=viewById&id=<?= htmlspecialchars($user['id']) ?>">View Details</a>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>

    <!-- User Details Table -->
    <h2>User Details</h2>
    <?php if (isset($selectedUser) && $selectedUser): ?>
        <table>
            <tr><th>ID</th><td><?= htmlspecialchars($selectedUser['id']) ?></td></tr>
            <tr><th>Username</th><td><?= htmlspecialchars($selectedUser['username']) ?></td></tr>
            <tr><th>Email</th><td><?= htmlspecialchars($selectedUser['email']) ?></td></tr>
            <tr><th>Phone</th><td><?= htmlspecialchars($selectedUser['phone']) ?></td></tr>
            <tr><th>Password</th><td><?= htmlspecialchars($selectedUser['password']) ?></td></tr>
            <tr><th>License</th><td><?= htmlspecialchars($selectedUser['license']) ?></td></tr>
            <tr><th>Clinic Name</th><td><?= htmlspecialchars($selectedUser['clinicname']) ?></td></tr>
            <tr><th>Speciality</th><td><?= htmlspecialchars($selectedUser['speciality']) ?></td></tr>
            <tr><th>Services</th><td><?= htmlspecialchars($selectedUser['services']) ?></td></tr>
            <tr><th>Working Hours</th><td><?= htmlspecialchars($selectedUser['working_hours']) ?></td></tr>
            <tr><th>Host Training</th><td><?= htmlspecialchars($selectedUser['host_training']) ?></td></tr>
        </table>
    <?php else: ?>
        <p>Select a user to view their details.</p>
    <?php endif; ?>
</body>
</html>
