<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../view/SignIn.php");
    exit();
}

if ($_SESSION['user_role'] !== 'Veterinarian') {
    header("Location: ../../view/SignIn.php?error=unauthorized");
    exit();
}

include '../control/UserController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinarian Homepage</title>
    <link rel="stylesheet" href="../css/Style.css"></link>
</head>
<body>
    <!-- Header -->
    <header>
        <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
            <img src="../../Main/images/Icon.png" alt="Veterinarian Logo" style="height: 60px;">
            <h1>Veterinarian Homepage</h1>
        </div>
        <nav>
            <a href="#home">Home</a>
            <a href="#rescue-missions">Rescue Missions</a>
            <a href="#adoption">Adopt an Animal</a>
            <!--<a href="#case-assessment">Case Assessment</a>-->
            <a href="#training">Training & Education</a>
            <a href="#medical-records">Medical Records</a>
            <a href="#funds">Funds</a>
        </nav>
    </header>

    <!-- Home Section -->
    <section id="home">
        <h2>Welcome, Veterinarian!</h2>
        <p>Manage rescue missions, review cases, maintain medical records, and train volunteers while making an impactful difference in animal welfare.</p>
    </section>

    <!-- Rescue Missions Section -->
    <section id="rescue-missions">
        <h2>View and Respond to Rescue Missions</h2>
        <p>Access and respond to rescue cases assigned to you. Review mission details and provide the necessary care for animals in need.</p>
        <button id="show-rescue-missions" class="btn">View Rescue Missions</button>
        <div id="rescue-missions-content" style="display: none;">
            <!-- Rescue Missions Section -->
            <h3>Ongoing Rescue Missions</h3>
            <p>Choose a mission to support and help in the rescue efforts.</p>
            <div id="missions">
            <?php
                // Check if there are rescue missions available
                if (!empty($rescueMissions)) {
                    // Start the table with proper HTML tags
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
                            <th>Action</th>
                        </tr>";

                    // Loop through rescue missions and display them row by row
                    foreach ($rescueMissions as $mission) {
                        echo "<tr id='mission-" . htmlspecialchars($mission['MissionID']) . "'>";
                        echo "<td>" . htmlspecialchars($mission['MissionID']) . "</td>";
                        echo "<td>" . htmlspecialchars($mission['MissionName']) . "</td>";
                        echo "<td>" . htmlspecialchars($mission['Description']) . "</td>";
                        echo "<td>" . htmlspecialchars($mission['ReportedBy']) . "</td>";
                        echo "<td>" . htmlspecialchars($mission['AssignedTo']) . "</td>";
                        echo "<td>" . htmlspecialchars($mission['Location']) . "</td>";
                        echo "<td>" . htmlspecialchars($mission['Status']) . "</td>";
                        echo "<td>" . htmlspecialchars($mission['PriorityLevel']) . "</td>";
                        if ($mission['Status'] == 'In Progress') {
                            echo "<td><button class='btn' onclick='completeMission(" . htmlspecialchars($mission['MissionID']) . ")'>Complete</button></td>";
                        } elseif ($mission['Status'] == 'Pending') {
                            echo "<td><button class='btn' onclick='acceptMission(" . htmlspecialchars($mission['MissionID']) . ")'>Accept</button></td>";
                        } else {
                            echo "<td></td>";  
                        }                        
                        
                        echo "</tr>";
                        
                    }

                    // Close the table tag
                    echo "</table>";
                } else {
                    // If no rescue missions are available, show this message
                    echo "<p>No rescue missions available.</p>";
                }
            ?>

            </div>
        </div>  
    </section>

    <section id="adoption">
        <h2>Adopt an Animal</h2>
        <p>View animals available for adoption and help them find their forever homes.</p>
        <a href="../../Main/view/Adoption.php" class="btn">View Animals</a>
    </section>

    
    <!-- Training Section -->
    <section id="training">
        <h2>Volunteer Training & Educational Resources (Coming Soon!)</h2>
        <p>Conduct training sessions and upload educational materials to equip volunteers with the knowledge to assist in rescue missions.</p>
        <a href="TrainingResources.php" class="btn">View Training Resources</a>
    </section>

    <!-- Medical Records Section -->
    <section id="medical-records">
        <h2>Manage Medical Records  (Coming Soon!)</h2>
        <p>Upload and track treatment plans, monitor recovery progress, and maintain comprehensive medical records for animals under your care.</p>
        <a class="btn">Manage Records</a>
    </section>

    <!-- Case Assessment Section 
    <section id="case-assessment">
        <h2>Review and Assess Cases</h2>
        <p>Review cases submitted by users, assess conditions, and update case statuses for rescue or medical follow-ups.</p>
        <a href="CaseAssessment.php" class="btn">Review Cases</a>
    </section>
    -->

    <!-- Funds Section -->
    <section id="funds">
        <h2>Receive Allocated Funds (Coming Soon!)</h2>
        <p>Access and manage funds allocated for treatment fees, ensuring every animal gets the care they need.</p>
        <a class="btn">View Funds</a>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2024 Veterinarian Dashboard | All Rights Reserved</p>
        <p>Follow us on: 
            <a href="#">Facebook</a> | 
            <a href="#">Twitter</a> | 
            <a href="#">Instagram</a>
        </p>
    </footer>

    <script src="../js/HomepageContent.js"></script>

</body>
</html>
