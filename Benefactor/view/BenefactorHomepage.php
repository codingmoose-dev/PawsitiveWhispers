<?php
session_start(); 

if (!isset($_SESSION['user_id'])) {
    header("Location: /PawsitiveWhispers/Main/view/SignIn.php");
    exit();
}

if ($_SESSION['user_role'] !== 'Benefactor') {
    header("Location: /PawsitiveWhispers/Main/view/SignIn.php?error=unauthorized");
    exit();
}

include '../control/HomepageDisplayController.php'; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawsitiveWhispers - Benefactor</title>
    <link rel="stylesheet" href="../css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2c3e50;">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <img src="../../Main/images/Icon.png" alt="PawsitiveWhispers Logo" style="height: 60px; width: auto;">
                <span class="fs-4">PawsitiveWhispers</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="#" data-section="home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-section="donate">Donate</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-section="adoption">Adopt an Animal</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-section="impact">Impact & Updates</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-section="transparency">Transparency</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-section="faq">Frequently Asked Questions</a></li>
                    <!-- Logout Button -->
                    <li class="nav-item">
                        <form action="/PawsitiveWhispers/Main/view/Logout.php" method="post" class="d-inline">
                            <button type="submit" class="nav-link btn btn-link">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="content-panel">
        
        <!-- Home Section -->
        <section id="home">
            <?php
            // Check if the user is logged in (i.e., session variables are set)
            if (isset($_SESSION['user_full_name']) && isset($_SESSION['user_id'])) {
                $fullName = $_SESSION['user_full_name'];
                $userID = $_SESSION['user_id'];
                echo "<h2>Welcome, Generous Benefactor $fullName (ID: $userID)!</h2>";
            } 
            ?>
            <p>Empowering change through compassion. Join our mission to rescue, rehabilitate, and support animals in need.</p>
            <p>Your contributions, whether as an individual donor, corporate sponsor, or NGO partner, make a meaningful and lasting impact on the lives of animals!</p>
        </section>

        <!-- Adoption Section -->
        <section id="adoption" style="display: none;">
            <h2>Adopt an Animal</h2>
            <p>Give a forever home to a rescued animal. Browse available animals and track your application status seamlessly.</p>
            <a href="../../Main/view/Adoption.php" class="btn">Explore Adoptions</a>
        </section>

        <!-- Impact Section -->
        <section id="impact" style="display: none;">
            <h2>See the Impact of Your Donations</h2>
            <p>Stay connected with the causes you support. View updates, success stories, and the outcomes of your generous contributions.</p>
            <a href="DonationImpact.php" class="btn">View Updates</a>
        </section>

        <!-- Transparency Section -->
        <section id="transparency" style="display: none;">
            <h2>Financial Transparency (Coming Soon!)</h2>
            <p>We value your trust. Access detailed reports on how your funds are utilized for rescues, treatments, and operations. Transparency is our priority!</p>
            <a class="btn">View Reports</a>
        </section>

    </div>


    <!-- Footer -->
    <footer>
        <p>© 2024 PawsitiveWhispers. All rights reserved.</p>
        <p>Follow us on: 
            <a href="#">Facebook</a> | 
            <a href="#">Twitter</a> | 
            <a href="#">Instagram</a>
        </p>
    </footer>

    <script src="../js/tabNavigation.js"></script>
    <script src="../js/ShowDetailHomepage.js"></script>
    
</body>
</html>