<?php
include '../control/UserController.php';
$vetModel = new VetModel(); // Initialize the model
$controller = new UserController($vetModel); // Pass it to the controller
$rescueMissions = $controller->getMissions();
?>

<section id="rescue-missions">
    <h2>Rescue Missions Table</h2>
    <table border="1" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <th>Mission ID</th>
                <th>Mission Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>Status</th>
                <th>Priority Level</th>
                <th>Registered Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($rescueMissions)): ?>
                <?php foreach ($rescueMissions as $mission): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($mission['MissionID']); ?></td>
                        <td><?php echo htmlspecialchars($mission['MissionName']); ?></td>
                        <td><?php echo htmlspecialchars($mission['Description']); ?></td>
                        <td><?php echo htmlspecialchars($mission['Location']); ?></td>
                        <td><?php echo htmlspecialchars($mission['Status']); ?></td>
                        <td><?php echo htmlspecialchars($mission['PriorityLevel']); ?></td>
                        <td><?php echo htmlspecialchars($mission['RegisteredDate']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No rescue missions available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>
