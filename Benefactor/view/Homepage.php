<?php
session_start(); 

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Benefactor') {
    header("Location: SignIn.php?error=unauthorized");
    exit();
}

include '../control/HomepageDisplaycontroller.php';
$activePage = 'home';
include '../includes/navbar.php';
?>

<main>
    <div class="container mt-4">
      <?php
        $fullName = $_SESSION['user_full_name'];
        $userID = $_SESSION['user_id'];
        echo "<h2>Welcome, Generous Benefactor $fullName (ID: $userID)!</h2>";
      ?>
      <p>Empowering change through compassion. Join our mission to rescue, rehabilitate, and support animals in need.</p>
      <p>Your contributions, whether as an individual donor, corporate sponsor, or NGO partner, make a meaningful and lasting impact!</p>
    </div>
</main>

<?php include '../includes/footer.php'; ?>