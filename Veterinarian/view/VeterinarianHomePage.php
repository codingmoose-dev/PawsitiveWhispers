<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinarian Homepage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 2.5em;
        }
        header nav {
            margin: 10px 0;
        }
        header nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1.1em;
        }
        header div {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        header img {
            height: 60px;
        }
        section {
            padding: 20px;
        }
        section h2 {
            color: #2c3e50;
        }
        #home {
            background-color: #f4f4f4;
            text-align: center;
            padding: 40px 20px;
        }
        #rescue-missions, #case-assessment, #medical-records, #training, #funds {
            background-color: #eaeaea;
            margin: 20px 0;
            padding: 40px 20px;
        }
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
        .btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            display: inline-block;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
            <img src="../../Main/images/Icon.png" alt="Veterinarian Logo" style="height: 60px;">
            <h1>Veterinarian Dashboard</h1>
        </div>
        <nav>
            <a href="#home">Home</a>
            <a href="#rescue-missions">Rescue Missions</a>
            <a href="#case-assessment">Case Assessment</a>
            <a href="#medical-records">Medical Records</a>
            <a href="#training">Training & Education</a>
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
        <a href="RescueMissions.php" class="btn">View Rescue Missions</a>
    </section>

    <!-- Case Assessment Section -->
    <section id="case-assessment">
        <h2>Review and Assess Cases</h2>
        <p>Review cases submitted by users, assess conditions, and update case statuses for rescue or medical follow-ups.</p>
        <a href="CaseAssessment.php" class="btn">Review Cases</a>
    </section>

    <!-- Medical Records Section -->
    <section id="medical-records">
        <h2>Manage Medical Records</h2>
        <p>Upload and track treatment plans, monitor recovery progress, and maintain comprehensive medical records for animals under your care.</p>
        <a href="MedicalRecords.php" class="btn">Manage Records</a>
    </section>

    <!-- Training Section -->
    <section id="training">
        <h2>Volunteer Training & Educational Resources</h2>
        <p>Conduct training sessions and upload educational materials to equip volunteers with the knowledge to assist in rescue missions.</p>
        <a href="TrainingResources.php" class="btn">View Training Resources</a>
    </section>

    <!-- Funds Section -->
    <section id="funds">
        <h2>Receive Allocated Funds</h2>
        <p>Access and manage funds allocated for treatment fees, ensuring every animal gets the care they need.</p>
        <a href="Funds.php" class="btn">View Funds</a>
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
</body>
</html>
