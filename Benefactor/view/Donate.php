<?php
session_start();
session_regenerate_id(true);

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Benefactor') {
    header("Location: SignIn.php?error=unauthorized");
    exit();
}

include '../control/HomepageDisplayController.php'; 
$activePage = 'donate';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Donate - PawsitiveWhispers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/Style.css" />
</head>
<body>
<?php include '../includes/navbar.php'; ?>

<section id="donate">
    <div class="content-wrapper">
        <h2>Donate to Make a Difference</h2>
        <p>Your contribution supports specific animal cases, campaigns, or general welfare funds.</p>

        <?php if (isset($_SESSION['donation_success'])): ?>
            <div class="alert-success"><?= $_SESSION['donation_success']; unset($_SESSION['donation_success']); ?></div>
        <?php elseif (isset($_SESSION['donation_error'])): ?>
            <div class="alert-error"><?= $_SESSION['donation_error']; unset($_SESSION['donation_error']); ?></div>
        <?php endif; ?>

        <!-- Campaigns -->
        <div class="section-block">
            <h3>Support Our Campaigns</h3>
            <p>Click below to view and donate to active campaigns.</p>
            <button id="show-more-donate" class="btn btn-primary">Show Campaigns</button>

            <div id="donate-more-content" class="campaigns-section">
                <?php include 'campaigns.php'; ?>
                <!-- Donation Form -->
                <form id="donation-form-campaign" method="POST" action="../control/DonateToCampaign.php" class="form">
                    <!-- Form Elements Here -->
                </form>
            </div>
        </div>

        <!-- Animal Donations -->
        <div class="section-block">
            <h3>Support Specific Animals</h3>
            <p>Donate directly to support individual animals with food, medicine, or transport.</p>
            <div class="grid-container" id="animals">
                <?php foreach ($animals as $animal): ?>
                    <div class="animal-card">
                        <img src="../../Main/<?= htmlspecialchars($animal['PicturePath']); ?>" alt="<?= htmlspecialchars($animal['Name']); ?>" />
                        <h4><?= htmlspecialchars($animal['Name']); ?></h4>
                        <!-- Other Animal Info -->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- General Fund -->
        <div class="section-block">
            <h3>General Fund Donations</h3>
            <form id="general-donation-form" method="POST" action="../control/DonateToGeneralFund.php" class="form">
                <!-- Donation Form Elements -->
            </form>
        </div>
    </div>
</section>

<script src="../js/ShowDetailHomepage.js"></script>
<?php include '../includes/footer.php'; ?>
</body>
</html>
