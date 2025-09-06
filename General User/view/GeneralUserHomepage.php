<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /PawsitiveWhispers/Main/view/SignIn.php");
    exit();
}

if ($_SESSION['user_role'] !== 'General') {
    header("Location: /PawsitiveWhispers/Main/view/SignIn.php?error=unauthorized");
    exit();
}

include '../control/HomeControls.php';
include '../includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawsitive Whispers</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/Style.css" />
</head>
<body>


        <?php if (isset($_SESSION['registration_success'])): ?>
            <div class="alert alert-success" id="success-message">
                Registration successful! Welcome to the team!
            </div>
            <script>
                setTimeout(function() {
                    var message = document.getElementById('success-message');
                    if (message) {
                        message.style.display = 'none';
                    }
                }, 10000); // 10,000 milliseconds = 10 seconds
            </script>
            <?php unset($_SESSION['registration_success']); ?>
        <?php endif; ?>

    <!-- Home Section -->
    <section id="home">
        <h2>WELCOME 
            <?php
            echo isset($_SESSION['user_full_name']) ? htmlspecialchars($_SESSION['user_full_name']) . "!" : 'Guest!';
            ?>
        </h2>
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
            <form id="animalForm" enctype="multipart/form-data">
                <div class="form-grid">
                    <label for="Name">Animal Name:</label>
                    <input type="text" id="Name" name="Name">
                </div>
                <div class="form-grid">
                    <label for="Species">Species:</label>
                    <input type="text" id="Species" name="Species">
                </div>
                <div class="form-grid">
                    <label for="Breed">Breed:</label>
                    <input type="text" id="Breed" name="Breed">
                </div>
                <div class="form-grid">
                    <label for="Age">Age:</label>
                    <input type="number" id="Age" name="Age">
                </div>
                <div class="form-grid">
                    <label for="Gender">Gender:</label>
                    <select id="Gender" name="Gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Unknown">Unknown</option>
                    </select>
                </div>
                <div class="form-grid">
                    <label for="AnimalCondition">Animal Condition:</label>
                    <select id="AnimalCondition" name="AnimalCondition">
                        <option value="Healthy">Healthy</option>
                        <option value="Injured">Injured</option>
                    </select>
                </div>
                <div class="form-grid">
                    <label for="RescueDate">Rescue Date:</label>
                    <input type="date" id="RescueDate" name="RescueDate">
                </div>
                <div class="form-grid">
                    <label for="AdoptionStatus">Adoption Status:</label>
                    <select id="AdoptionStatus" name="AdoptionStatus">
                        <option value="UnderCare">Under Care</option>
                        <option value="Adopted">Adopted</option>
                        <option value="Available">Available</option>
                    </select>
                </div>
                <div id="shelterDropdown" class="form-grid">
                    <label for="ShelterID">Select Shelter:</label>
                    <select id="ShelterID" name="ShelterID"></select>
                </div>
                <div class="form-grid">
                    <label for="picture">Animal Picture:</label>
                    <input type="file" id="picture" name="picture" accept="image/*">
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
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
        <a class="btn">Make a Donation</a>
    </section>

    <!-- Resources Section -->
    <section id="resources">
        <h2>Educational Content & Emergency Hotlines (Coming Soon!)</h2>
        <p>Access a library of animal care videos and guides. Need urgent help? Contact our emergency hotline for immediate assistance.</p>
        <button class="btn">View Resources</button>
    </section>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/ShowDetailHomepage.js"></script>

</body>
</html>
