<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Volunteer Dashboard - PawsitiveWellbeing</title>
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

        #missions, #adoption, #volunteers {

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
<img src="../../Main/images/Icon.png" alt="PawsitiveWellbeing Logo" style="height: 60px;">
<h1>PawsitiveWellbeing</h1>
</div>
<nav>
<a href="#home">Home</a>
<a href="#missions">Rescue Missions</a>
<a href="#adoption">Adopt an Animal</a>
<a href="#volunteers">Collaborate</a>
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
    <a href="ViewMissions.php" class="btn">View Missions</a>
    <a href="UpdateCase.php" class="btn">Update Case</a>
    </section>
 
    <!-- Adoption Section -->
<section id="adoption">
<h2>Animal Adoption</h2>
<p>Help manage the adoption process. Review applications, coordinate handovers, and track the journey of animals finding their forever homes.</p>
<a href="../../Main/view/Adoption.php" class="btn">Adopt an Animal</a>
</section>
 
    <!-- Volunteer Collaboration Section -->
<section id="volunteers">
<h2>Collaborate with Other Volunteers</h2>
<p>Connect with fellow volunteers for collaborative rescue missions. Share updates, plan strategies, and make teamwork seamless.</p>
<a href="VolunteerCollaboration.php" class="btn">Collaborate</a>
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
</body>
</html>

 