<?php
session_start();

if (isset($_SESSION['registration_success'])) {
    echo "<p>Registration successful! Welcome to the team!</p>";
    unset($_SESSION['registration_success']);
}

include '../control/VolunteerHomeControls.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Dashboard - PawsitiveWellbeing</title>
    <link rel="stylesheet" href="../css/Style.css">
</head>
<body>
<!-- Header -->
<header>
    <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
        <img src="../../Main/images/Icon.png" alt="PawsitiveWellbeing Logo" style="height: 60px;">
        <h1>PawsitiveWellbeing</h1>
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
<section id="missions">
    <h2>View & Respond to Rescue Missions</h2>
    <p>Check out assigned rescue cases or ongoing missions. Update case statuses, upload animal condition reports, and track your progress.</p>
    <button id="show-rescue-missions" class="btn">View Rescue Missions</button>
    <div id="rescue-missions-content" style="display: none;">
        <h3>Ongoing Rescue Missions</h3>
        <p>Choose a mission to support and help in the rescue efforts.</p>
        <div id="missions">
            <?php
            if (!empty($rescueMissions)) {
                echo "<table border='1' cellpadding='10' cellspacing='0'>";
                echo "<tr>
                        <th>Mission ID</th>
                        <th>Mission Name</th>
                        <th>Description</th>
                        <th>Reported By</th>
                        <th>Assigned To</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Priority Level</th>
                        <th>Actions</th>
                    </tr>";

                foreach ($rescueMissions as $mission) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($mission['MissionID']) . "</td>";
                    echo "<td>" . htmlspecialchars($mission['MissionName']) . "</td>";
                    echo "<td>" . htmlspecialchars($mission['Description']) . "</td>";
                    echo "<td>" . htmlspecialchars($mission['ReportedBy']) . "</td>";
                    echo "<td>" . htmlspecialchars($mission['AssignedTo']) . "</td>";
                    echo "<td>" . htmlspecialchars($mission['Location']) . "</td>";
                    echo "<td>" . htmlspecialchars($mission['Status']) . "</td>";
                    echo "<td>" . htmlspecialchars($mission['PriorityLevel']) . "</td>";
                    echo "<td><button class='btn join-btn'>Join</button></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No rescue missions available.</p>";
            }
            ?>
        </div>
    </div>
</section>

<!-- Volunteer Collaboration Section -->
<section id="volunteers">
    <h2>Collaborate with Other Volunteers</h2>
    <p>Connect with fellow volunteers for collaborative rescue missions. Share updates, plan strategies, and make teamwork seamless.</p>
    <button id="collaborate-btn" class="btn">Collaborate</button>

    <!-- Search Bar (Initially Hidden) -->
    <div id="search-bar" style="display: none;">
        <input type="number" id="volunteer-id" name="volunteerID" placeholder="Enter Volunteer ID">
        <button id="search-btn" class="btn">Search</button>
    </div>

    <!-- Volunteer Details Table (Initially Hidden) -->
    <div id="volunteer-details" style="display: none;">
        <h3>Volunteer Details</h3>
        <table id="volunteer-table" border="1" cellpadding="10" cellspacing="0">
            <!-- Table will be populated dynamically -->
        </table>
        <button id="connect-btn" class="btn">Connect</button>
    </div>
</section>

<!-- Adoption Section -->
<section id="adoption">
    <h2>Animal Adoption</h2>
    <p>Help manage the adoption process. Review applications, coordinate handovers, and track the journey of animals finding their forever homes.</p>
    <a href="../../Main/view/Adoption.php" class="btn">Adopt an Animal</a>
</section>

<!-- Footer -->
<footer>
    <p>© 2024 PawsitiveWellbeing | All Rights Reserved</p>
    <p>Follow us on: 
        <a href="#">Facebook</a> | 
        <a href="#">Twitter</a> | 
        <a href="#">Instagram</a>
    </p>
</footer>

<script src="../js/ShowDetailHomepage.js"></script>
</body>
</html>
