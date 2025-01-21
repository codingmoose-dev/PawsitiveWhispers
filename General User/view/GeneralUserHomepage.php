<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawsitiveWellbeing</title>
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
        #submit-case, #adoption, #donate, #resources {
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
        form input, form textarea, form button {
            display: block;
            margin: 10px 0;
            width: 100%;
            max-width: 500px;
            padding: 10px;
            font-size: 1em;
        }
        form button {
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        form button:hover {
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
            <a href="#submit-case">Submit a Case</a>
            <a href="#donate">Donate</a>
            <a href="#adoption">Adopt an Animal</a>
            <a href="#resources">Educational Resources</a>
        </nav>
    </header>

    <!-- Home Section -->
    <section id="home">
        <h2>WELCOME USER!</h2>
        <p>Your one-stop platform for animal rescue and welfare. Join us in saving lives and creating a positive change!</p>
        <p>Discover features like case reporting, adoptions, donations, and valuable educational resources.</p>
    </section>

    <!-- Submit Case Section -->
    <section id="submit-case">
        <h2>Submit Animal Injury Cases</h2>
        <p>Spotted an injured animal? Submit a case by providing details, photos/videos, and location. Our team will take it from there!</p>
        <a href="SubmitCase.php" class="btn">Submit a Case</a>
    </section>

    <!-- Adoption Section -->
    <section id="adoption">
        <h2>Animal Adoption</h2>
        <p>Looking to adopt? Browse available animals and apply for adoption. Track your application status and give a furry friend a forever home.</p>
        <a href="../../Main/view/Adoption.php" class="btn">Adopt an Animal</a>
    </section>

    <!-- Donate Section -->
    <section id="donate">
        <h2>Donate</h2>
        <p>Support our mission by donating to specific rescue cases or general campaigns. Your contributions save lives!</p>
        <a href="Donate.php" class="btn">Make a Donation</a>
    </section>

    <!-- Resources Section -->
    <section id="resources">
        <h2>Educational Content & Emergency Hotlines</h2>
        <p>Access a library of animal care videos and guides. Need urgent help? Contact our emergency hotline for immediate assistance.</p>
        <a href="Resources.php" class="btn">View Resources</a>
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
