<?php
session_start();

// AUTHENTICATION
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Benefactor') {
    header("Location: SignIn.php?error=unauthorized");
    exit();
}

require_once '../control/HomepageDisplayController.php'; 
$displayController = new HomepageDisplayRequests();
$pageData = $displayController->getHomepageData($_SESSION['user_id']);

// Extract the variables the view needs
$campaigns = $pageData['campaigns'];
$animals = $pageData['animals'];

$activePage = 'donate';
include '../includes/navbar.php'; 
?>

<main>
<section id="donate"  class="container-fluid py-4">
    <h2>Donate to Make a Difference</h2>
    <p>Your contribution supports specific animal cases, campaigns, or general welfare funds.</p>

    <?php if (isset($_SESSION['donation_success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['donation_success']); unset($_SESSION['donation_success']); ?></div>
    <?php elseif (isset($_SESSION['donation_error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['donation_error']); unset($_SESSION['donation_error']); ?></div>
    <?php endif; ?>

    <div class="my-5">
        <h3>Support Our Campaigns</h3>
        <table class="table table-bordered table-striped">
            <tbody>
                <?php foreach ($campaigns as $campaign): ?>
                <tr>
                    <td><?= htmlspecialchars($campaign['CampaignName']); ?></td>
                    <td><?= htmlspecialchars($campaign['Description']); ?></td>
                    <td>
                        </td>
                    <td>
                        <form method="POST" action="../control/DonationActionController.php">
                            <input type="hidden" name="campaign_id" value="<?= $campaign['CampaignID']; ?>">
                            <input type="number" name="amount" placeholder="Amount" class="form-control mb-2" required>
                            <button type="submit" class="btn btn-primary btn-sm">Donate</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="my-5">
        <h3>Sponsor an Animal in Need</h3>
        <p>Your support provides food, medicine, and care for animals waiting for their forever home.</p>
        
        <div class="grid-container">
            <?php if (!empty($animals)): ?>
                <?php foreach ($animals as $animal): ?>
                <div class="animal-card">
                    
                    <div class="animal-image-container">
                        <img src="../../Main/<?= htmlspecialchars($animal['PicturePath']); ?>" alt="<?= htmlspecialchars($animal['Name']); ?>" />
                    </div>
                    
                    <div class="animal-card-body">
                        <h4><?= htmlspecialchars($animal['Name']); ?></h4>
                        <p>
                            <strong>Species:</strong> <?= htmlspecialchars($animal['Species']); ?><br>
                            <strong>Breed:</strong> <?= htmlspecialchars($animal['Breed']); ?><br>
                            <strong>Age:</strong> <?= htmlspecialchars($animal['Age'] ?? 'N/A'); ?> years
                        </p>

                        <?php 
                            $condition = !empty($animal['LatestDiagnosis']) ? $animal['LatestDiagnosis'] : $animal['AnimalCondition'];
                        ?>
                        <?php if (!empty($condition)): ?>
                            <p><strong>Condition:</strong> <span class="animal-condition"><?= htmlspecialchars($condition); ?></span></p>
                        <?php endif; ?>
                    </div>

                    <form method="POST" action="../control/DonationActionController.php" class="mt-auto">
                        <input type="hidden" name="action" value="processDonation">
                        <input type="hidden" name="animal_id" value="<?= $animal['AnimalID']; ?>">
                        
                        <div class="form-group mb-2">
                            <input type="number" name="amount" placeholder="Sponsor Amount ($)" class="form-control" required min="1">
                        </div>
                        
                        <div class="form-group mb-2">
                            <select name="purpose" class="form-select" required>
                                <option value="" disabled selected>Select a purpose...</option>
                                <option value="Animal Food">Animal Food</option>
                                <option value="Medicine">Medicine</option>
                                <option value="Transport">Transport</option>
                                <option value="General Care">General Care</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Sponsor <?= htmlspecialchars($animal['Name']); ?></button>
                    </form>

                </div> <?php endforeach; ?>
            <?php else: ?>
                <p>All animals are currently cared for. Thank you for your support!</p>
            <?php endif; ?>
        </div>
    </div>
    
</section>
</main>

<?php include '../includes/footer.php'; ?>