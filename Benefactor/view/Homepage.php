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
        echo "<h4>Welcome, Generous Benefactor $fullName (ID: $userID)!</h4>";
      ?>
      <h1>Rescue. Heal. Home.</h1>
      <h4 class="tagline">Your donation completes the journey.</h4>
    </div>
</main>

<?php include '../includes/footer.php'; ?>