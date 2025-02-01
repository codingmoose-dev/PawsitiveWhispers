<?php
include ''

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawsitiveWellbeing</title>
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
        <button id="show-submit-case" class="btn">Submit a Case</button>

            <!-- Hidden Form for animal case submission -->
           <div id="SubmitCaseContent" class="grid-container" style="display: none;">
                <h1>Submit an Animal Case</h1>

                <!-- Message display area -->
                <div id="message" style="color: green; font-weight: bold; margin-bottom: 10px;"></div>

                <!-- Form for animal case submission -->
                <form id="animalForm" enctype="multipart/form-data">
                    <label for="name">Animal Name:</label>
                    <input type="text" id="name" name="name"><br>

                    <label for="species">Species:</label>
                    <input type="text" id="species" name="species"><br>

                    <label for="breed">Breed:</label>
                    <input type="text" id="breed" name="breed"><br>

                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age"><br>

                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Unknown">Unknown</option>
                    </select><br>

                    <label for="animal_condition">Animal Condition:</label>
                    <textarea id="animal_condition" name="animal_condition"></textarea><br>

                    <label for="rescue_date">Rescue Date:</label>
                    <input type="date" id="rescue_date" name="rescue_date"><br>

                    <label for="adoption_status">Adoption Status:</label>
                    <select id="adoption_status" name="adoption_status">
                        <option value="UnderCare">Under Care</option>
                        <option value="Adopted">Adopted</option>
                        <option value="Available">Available</option>
                    </select><br>

                    <label for="case_type">Case Type:</label>
                    <select id="case_type" name="case_type">
                        <option value="injured">Injured</option>
                        <option value="adoption">Adoption</option>
                    </select><br>

                    <!-- Shelter dropdown (hidden initially) -->
                    <div id="shelterDropdown" style="display: none;">
                        <label for="shelter">Select Shelter:</label>
                        <select id="shelter" name="shelter"></select><br>
                    </div>

                    <!-- Image upload for PicturePath -->
                    <label for="picture">Animal Picture:</label>
                    <input type="file" id="picture" name="picture" accept="image/*"><br>

                    <button type="submit">Submit</button>
                </form>

                <script src="../js/Script.js"></script>
            </div>
    </section>

    <!-- Donate Section -->
    <section id="donate">
        <h2>Donate</h2>
        <p>Support our mission by donating to specific rescue cases or general campaigns. Your contributions save lives!</p>
        <a href="Donate.php" class="btn">Make a Donation</a>
    </section>

    <!-- Adoption Section -->
    <section id="adoption">
        <h2>Animal Adoption</h2>
        <p>Looking to adopt? Browse available animals and apply for adoption. Track your application status and give a furry friend a forever home.</p>
        <a href="../../Main/view/Adoption.php" class="btn">Adopt an Animal</a>
    </section>

    <!-- Resources Section -->
    <section id="resources">
        <h2>Educational Content & Emergency Hotlines (Coming Soon!)</h2>
        <p>Access a library of animal care videos and guides. Need urgent help? Contact our emergency hotline for immediate assistance.</p>
        <button class="btn">View Resources</button>
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
