<?php
session_start();

include '../control/VolunteerHomeControls.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /PawsitiveWhispers/Main/view/SignIn.php");
    exit();
}

if ($_SESSION['user_role'] !== 'Volunteer') {
    header("Location: /PawsitiveWhispers/Main/view/SignIn.php?error=unauthorized");
    exit();
}

if (isset($_SESSION['registration_success'])) {
    echo "<p>Registration successful! Welcome to the team!</p>";
    unset($_SESSION['registration_success']);
}

// Load controller
$volunteerController = new VolunteerHomeControls();
$capabilities = $volunteerController->getVolunteerCapabilities($_SESSION['user_id']);

$rescueMissions = (!empty($capabilities) && $capabilities['EmergencyRescue']) 
    ? $volunteerController->displayOngoingRescueMissions() 
    : [];

$canManageAdoption = (!empty($capabilities) && $capabilities['ManageAdoption']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Dashboard - Pawsitive Whispers</title>
    <link rel="stylesheet" href="../css/Style.css">
</head>
<body>
    <header>
        <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
            <img src="../../Main/images/Icon.png" alt="PawsitiveWhispers Logo" style="height: 60px;">
            <h1>Pawsitive Whispers</h1>
        </div>
        <nav>
            <a href="#home">Home</a>
            <a href="#missions">Rescue Missions</a>
            <a href="#volunteers">Collaborate</a>
            <a href="#adoption">Adopt an Animal</a>
        </nav>
    </header>

    <!-- Home Section -->
    <section id="home">
        <h2>WELCOME, VOLUNTEER!</h2>
        <p>Join hands with other volunteers to respond to rescue missions, coordinate adoptions, and make a positive impact on animal welfare.</p>
        <p>Your contributions save lives. Let's make a difference together!</p>
    </section>

    <!-- Rescue Missions Section -->
    <?php if (!empty($rescueMissions)) : ?>
    <section id="missions">
        <h2>View & Respond to Rescue Missions</h2>
        <p>Check out assigned rescue cases or ongoing missions. Update case statuses, upload animal condition reports, and track your progress.</p>
        <div id="rescue-missions-content">
            <h3>Ongoing Rescue Missions</h3>
            <p>Choose a mission to support and help in the rescue efforts.</p><br>
            <div id="missions">
                <table border="1" cellpadding="10" cellspacing="0">
                    <tr>
                        <th>Mission ID</th>
                        <th>Mission Name</th>
                        <th>Description</th>
                        <th>Reported By</th>
                        <th>Assigned Volunteer</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Priority Level</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($rescueMissions as $mission): ?>
                        <tr>
                            <td><?= htmlspecialchars($mission['MissionID']) ?></td>
                            <td><?= htmlspecialchars($mission['MissionName']) ?></td>
                            <td><?= htmlspecialchars($mission['Description']) ?></td>
                            <td><?= htmlspecialchars($mission['ReporterName']) ?></td>
                            <td><?= htmlspecialchars($mission['AssignedVolunteerName'] ?? 'Unassigned') ?></td>
                            <td><?= htmlspecialchars($mission['Location']) ?></td>
                            <td><?= htmlspecialchars($mission['Status']) ?></td>
                            <td><?= htmlspecialchars($mission['PriorityLevel']) ?></td>
                            <td>
                                <?php if ($_SESSION['user_id'] == $mission['AssignedVolunteerID']) : ?>
                                    <form method="POST" action="../control/UpdateRescueStatus.php">
                                        <input type="hidden" name="mission_id" value="<?= $mission['MissionID'] ?>">
                                        <select name="status">
                                            <option value="In Progress">In Progress</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                        <button type="submit" class="btn">Update</button>
                                    </form>
                                <?php else: ?>
                                    <span>Not Assigned</span>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Volunteer Collaboration Section -->
    <section id="volunteers">
        <h2>Collaborate with Other Volunteers</h2>
        <p>Connect with fellow volunteers for collaborative rescue missions. Share updates, plan strategies, and make teamwork seamless.</p>
        <div id="search-bar">
            <input type="number" id="volunteer-id" name="volunteerID" placeholder="Enter Volunteer ID">
            <button id="search-btn" class="btn">Search</button>
        </div>

        <div id="volunteer-details">
            <h3>Volunteer Details</h3>
            <table id="volunteer-table" border="1" cellpadding="10" cellspacing="0">
                <!-- Table will be populated dynamically -->
            </table>
            <button id="connect-btn" class="btn">Connect</button>
        </div>
    </section>

    <!-- Adoption Section -->
    <?php if ($canManageAdoption): ?>
    <section id="adoption">
        <h2>Animal Adoption</h2>
        <p>Help manage the adoption process. Review applications, coordinate handovers, and track the journey of animals finding their forever homes.</p>
        <a href="../../Main/view/Adoption.php" class="btn">Adopt an Animal</a>
    </section>
    <?php endif; ?>

    <section id="training">
        <h2>Volunteer Training & Stories</h2>
        <p>Explore training videos and inspiring stories to prepare yourself for animal rescue missions and community campaigns.</p>
        <a href="../../Main/view/TrainingLibrary.php" class="btn">View Training Materials</a>
    </section>

    <section id="map-section">
        <h2>Rescue Mission Map</h2>
        <p>Visualize current missions on a map to better plan routes and logistics.</p>
        <div id="rescue-map" style="height: 400px; width: 100%;"></div>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2024 Pawsitive Whispers | All Rights Reserved</p>
        <p>Follow us on: 
            <a href="#">Facebook</a> | 
            <a href="#">Twitter</a> | 
            <a href="#">Instagram</a>
        </p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const map = L.map('rescue-map').setView([23.8103, 90.4125], 6); // Bangladesh center
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data © OpenStreetMap contributors'
            }).addTo(map);

            <?php foreach ($rescueMissions as $mission): 
                // Extract lat/lng from "lat,lng" string in PHP
                $coords = explode(',', $mission['Location']);
                $lat = isset($coords[0]) ? trim($coords[0]) : '';
                $lng = isset($coords[1]) ? trim($coords[1]) : '';
            ?>
            L.marker([<?= json_encode($lat) ?>, <?= json_encode($lng) ?>])
                .addTo(map)
                .bindPopup("<?= addslashes($mission['MissionName']) ?>");
            <?php endforeach; ?>
        });

        function extractLat(location) {
            // Example function to extract lat/lng from "lat,lng" format
            return location.split(",")[0].trim();
        }

        function extractLng(location) {
            return location.split(",")[1].trim();
        }
    </script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

</body>
</html>
