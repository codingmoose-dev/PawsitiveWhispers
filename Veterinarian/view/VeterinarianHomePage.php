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
        #rescue-missions, #case-management, #adoption, #volunteer-network {
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
            <h1>Veterinarian Homepage</h1>
        </div>
        <nav>
            <a href="#home">Home</a>
            <a href="#rescue-missions">Rescue Missions</a>
            <a href="#case-management">Case Management</a>
            <a href="#adoption">Adoption</a>
            <a href="#volunteer-network">Volunteer Network</a>
        </nav>
    </header>

    <!-- Home Section -->
    <section id="home">
        <h2>Welcome, Veterinarian!</h2>
        <p>Your dedicated space to manage rescue missions, adoption processes, and collaborate with volunteers to make a difference in animal welfare.</p>
    </section>

    <!-- Rescue Missions Section -->
    <section id="rescue-missions">
        <h2>View and Respond to Rescue Missions</h2>
        <p>Access your assigned rescue cases. Review details, update progress, and provide immediate care to animals in need.</p>
        <a href="RescueMissions.php" class="btn">View Rescue Missions</a>
    </section>

    <!-- Case Management Section -->
    <section id="case-management">
        <h2>Manage Cases</h2>
        <p>Update the status of rescue cases, report animal conditions, and upload progress to keep the system informed.</p>
        <a href="CaseManagement.php" class="btn">Manage Cases</a>
    </section>

    <!-- Adoption Section -->
    <section id="adoption">
        <h2>Animal Adoption</h2>
        <p>Oversee the adoption process, review applications, and coordinate animal handovers to their forever homes.</p>
        <a href="../../Main/view/Adoption.php" class="btn">Manage Adoptions</a>
    </section>

    <!-- Volunteer Network Section -->
    <section id="volunteer-network">
        <h2>Volunteer Network</h2>
        <p>Connect with fellow volunteers to coordinate rescue missions and collaborate on animal welfare initiatives.</p>
        <a href="VolunteerNetwork.php" class="btn">Connect with Volunteers</a>
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
