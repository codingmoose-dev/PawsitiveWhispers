<?php
require_once '../control/UserController.php';
require_once '../model/VetModel.php';

// Instantiate the model and controller
$vetModel = new VetModel();
$userController = new UserController($vetModel);

// Fetch all veterinarians
$userController->viewAllVeterinarians();

// Handle search if submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vet_id'])) {
    $userController->searchById();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Veterinarians</title>
</head>
<body>
    <h1>All Veterinarians</h1>

    <!-- Display message (if any) -->
    <p><?php echo $message; ?></p>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Clinic Name</th>
                <th>Specialty</th>
                <th>Active</th>
                <th>View Details</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($veterinarians)) { ?>
                <?php foreach ($veterinarians as $vet) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($vet['VeterinarianID']); ?></td>
                        <td><?php echo htmlspecialchars($vet['FullName']); ?></td>
                        <td><?php echo htmlspecialchars($vet['Email']); ?></td>
                        <td><?php echo htmlspecialchars($vet['Phone']); ?></td>
                        <td><?php echo htmlspecialchars($vet['ClinicName']); ?></td>
                        <td><?php echo htmlspecialchars($vet['Speciality']); ?></td>
                        <td><?php echo $vet['LocationEnabled'] ? 'Yes' : 'No'; ?></td>
                        <td><a href="view_all_veterinarians.php?id=<?php echo htmlspecialchars($vet['VeterinarianID']); ?>">View Details</a></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="8"><?php echo "No veterinarians found."; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <hr>

    <h2>Search Veterinarian by ID</h2>
    <form method="POST" action="view_all_veterinarians.php">
        <label for="vet_id">Veterinarian ID:</label>
        <input type="text" id="vet_id" name="vet_id" required>
        <button type="submit">Search</button>
    </form>

    <!-- Display search results if available -->
    <?php if (isset($veterinarian)) { ?>
        <h3>Veterinarian Details</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <td><?php echo htmlspecialchars($veterinarian['VeterinarianID']); ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?php echo htmlspecialchars($veterinarian['FullName']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($veterinarian['Email']); ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?php echo htmlspecialchars($veterinarian['Phone']); ?></td>
            </tr>
            <tr>
                <th>Clinic Name</th>
                <td><?php echo htmlspecialchars($veterinarian['ClinicName']); ?></td>
            </tr>
            <tr>
                <th>Specialty</th>
                <td><?php echo htmlspecialchars($veterinarian['Speciality']); ?></td>
            </tr>
            <tr>
                <th>Active</th>
                <td><?php echo $veterinarian['LocationEnabled'] ? 'Yes' : 'No'; ?></td>
            </tr>
        </table>
    <?php } ?>
</body>
</html>
