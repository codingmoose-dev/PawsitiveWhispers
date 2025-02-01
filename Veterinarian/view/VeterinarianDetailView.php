<?php
include '../control/UserController.php'
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
    <!-- Veterinarian Table -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Password</th>
                <th>Clinic Address</th>
                <th>Location Enabled</th>
                <th>License</th>
                <th>Clinic Name</th>
                <th>Specialty</th>
                <th>Services</th>
                <th>Working Hours</th>
                <th>Vet License Path</th>
                <th>Gov ID Path</th>
                <th>Training Materials Path</th>
                <th>Host Training</th>
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
                        <td><?php echo htmlspecialchars($vet['Password']); ?></td>
                        <td><?php echo htmlspecialchars($vet['ClinicAddress']); ?></td>
                        <td><?php echo $vet['LocationEnabled'] ? 'Yes' : 'No'; ?></td>
                        <td><?php echo htmlspecialchars($vet['License']); ?></td>
                        <td><?php echo htmlspecialchars($vet['ClinicName']); ?></td>
                        <td><?php echo htmlspecialchars($vet['Speciality']); ?></td>
                        <td><?php echo htmlspecialchars($vet['Services']); ?></td>
                        <td><?php echo htmlspecialchars($vet['WorkingHours']); ?></td>
                        <td><?php echo htmlspecialchars($vet['VetLicensePath']); ?></td>
                        <td><?php echo htmlspecialchars($vet['GovIDPath']); ?></td>
                        <td><?php echo htmlspecialchars($vet['TrainingMaterialsPath']); ?></td>
                        <td><?php echo htmlspecialchars($vet['HostTraining']); ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="16">No veterinarians found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Search Form -->
    <h2>Search Veterinarian by ID</h2>
    <form method="POST">
        <label for="vet_id">Veterinarian ID:</label>
        <input type="text" id="vet_id" name="vet_id" >
        <button type="submit">Search</button>
    </form>

    <!-- Display search result -->
    <?php if ($veterinarian) { ?>
    <h3>Veterinarian Details</h3>
    <table border="1">
        <?php foreach ($veterinarian as $key => $value) { ?>
            <tr>
                <th><?php echo htmlspecialchars($key); ?></th>
                <td><?php echo htmlspecialchars($value); ?></td>
            </tr>
        <?php } ?>
    </table>
    <?php } else { ?>
        <p>No veterinarian found.</p>
    <?php } ?>

</body>
</html>
