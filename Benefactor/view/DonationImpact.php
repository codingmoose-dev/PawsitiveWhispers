<?php
session_start();
$activePage = 'impact';
include '../includes/navbar.php';

include '../control/HomepageDisplayController.php';

$benefactorId = null;
$donations = [];

if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'Benefactor') {
    $benefactorId = $_SESSION['user_id'];
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['benefactor_id'])) {
    $benefactorId = (int)$_POST['benefactor_id'];
}

if ($benefactorId) {$donations = getDonationsByBenefactor($benefactorId);
}

?>

<div class="container mt-4">
    <h2>See the Impact of Your Donations</h2>
    <p>Stay connected with the causes you support. View updates, success stories, and the outcomes of your generous contributions.</p>

    <?php if (!$benefactorId): ?>
        <!-- Show form to enter Benefactor ID if not logged in as benefactor -->
        <form method="post" action="">
            <label for="benefactor_id">Enter your Benefactor ID:</label>
            <input type="number" name="benefactor_id" id="benefactor_id" required>
            <button type="submit" class="btn">Submit</button>
        </form>
    <?php else: ?>
        <?php if (!empty($donations)): ?>
            <h3>Your Donations</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Donation Amount</th>
                        <th>Campaign Name</th>
                        <th>Donation Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($donations as $donation): ?>
                        <tr>
                            <td>$<?= htmlspecialchars($donation['DonationAmount']) ?></td>
                            <td><?= htmlspecialchars($donation['CampaignName'] ?? 'General Fund') ?></td>
                            <td><?= htmlspecialchars($donation['DonationDate']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h3>Animals Benefited</h3>
            <div class="grid-container">
                <?php
                // To avoid repeating animal cards for donations to same animal,
                // collect unique animals from donations
                $uniqueAnimals = [];
                foreach ($donations as $donation) {
                    if (!empty($donation['AnimalID']) && !isset($uniqueAnimals[$donation['AnimalID']])) {
                        $uniqueAnimals[$donation['AnimalID']] = $donation;
                    }
                }
                ?>
                <?php foreach ($uniqueAnimals as $animal): ?>
                    <div class="animal-card">
                        <img src="../../Main/<?= htmlspecialchars($animal['PicturePath']) ?>.jpg" alt="<?= htmlspecialchars($animal['AnimalName']) ?>" class="animal-image">
                        <h4><?= htmlspecialchars($animal['AnimalName']) ?></h4>
                        <p>Species: <?= htmlspecialchars($animal['AnimalSpecies']) ?></p>
                        <p>Breed: <?= htmlspecialchars($animal['AnimalBreed']) ?></p>
                        <p>Age: <?= htmlspecialchars($animal['AnimalAge']) ?> years</p>
                        <p>Condition: <?= htmlspecialchars($animal['AnimalCondition']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No donations found for this Benefactor ID.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
