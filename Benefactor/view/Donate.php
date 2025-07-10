<?php
session_start();

// Role check
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Benefactor') {
    header("Location: SignIn.php?error=unauthorized");
    exit();
}

include '../control/HomepageDisplayController.php'; 
$activePage = 'donate';
include '../includes/navbar.php';
?>

<!-- Donate Section -->
<section id="donate">
    <h2>Donate to Make a Difference</h2>
    <p>Support our mission by donating to specific animal cases, campaigns, or general funds. Your contributions directly help animals in need.</p>

    <p>Choose how you want to contribute:</p>
    
    <h3>Support Our Campaigns</h3>
    <p>Support ongoing campaigns to help animals in need. Your donations will go directly to the campaign of your choice.</p>
    <p>Click the button below to view and donate to our current campaigns.</p>
    <button id="show-more-donate" class="btn">Show Campaigns</button>

    <div id="donate-more-content" style="display: none;">

        <!-- CAMPAIGN DONATIONS -->
        <h3>Ongoing Campaigns</h3>
        <p>Choose a campaign to support and make a positive impact on the lives of animals in need.</p>
        <div id="campaigns">
            <?php if (!empty($campaigns)): ?>
                <table border="1" cellpadding="10" cellspacing="0">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Goal</th>
                        <th>Raised</th>
                        <th>By</th>
                    </tr>
                    <?php foreach ($campaigns as $c): ?>
                        <tr>
                            <td><?= htmlspecialchars($c['CampaignID']) ?></td>
                            <td><?= htmlspecialchars($c['CampaignName']) ?></td>
                            <td><?= htmlspecialchars($c['Description']) ?></td>
                            <td><?= htmlspecialchars($c['StartDate']) ?></td>
                            <td><?= htmlspecialchars($c['EndDate']) ?></td>
                            <td>$<?= htmlspecialchars($c['GoalAmount']) ?></td>
                            <td>$<?= htmlspecialchars($c['RaisedAmount']) ?></td>
                            <td><?= htmlspecialchars($c['CreatedBy']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No campaigns available at this time.</p>
            <?php endif; ?>
        </div>

        <!-- Donate to Campaign -->
        <form id="donation-form-campaign" method="POST" action="../control/DonateToCampaign.php">
            <h4>Donate to a Campaign</h4>
            <input type="number" name="campaign_id" placeholder="Campaign ID" required>
            <input type="number" name="amount" placeholder="Donation Amount" required min="1">
            <select name="donation_type" required>
                <option value="" disabled selected>Donation Type</option>
                <option value="One-time">One-time</option>
                <option value="Monthly">Monthly</option>
            </select>
            <button class="btn" type="submit">Donate</button>
        </form>
    </div>

    
        <!-- ANIMAL CASES -->
        <h3>Support Specific Animals</h3>
        <p>Donate directly to animals for food, medicine, or transportation needs.</p>
        <div id="animals" class="grid-container">
            <?php foreach ($animals as $animal): ?>
                <div class="animal-card">
                    <img src="../../Main/<?= htmlspecialchars($animal['PicturePath']) ?>.jpg" alt="<?= htmlspecialchars($animal['Name']) ?>" class="animal-image">
                    <h4><?= htmlspecialchars($animal['Name']) ?></h4>
                    <p>Species: <?= htmlspecialchars($animal['Species']) ?></p>
                    <p>Breed: <?= htmlspecialchars($animal['Breed']) ?></p>
                    <p>Age: <?= htmlspecialchars($animal['Age']) ?> years</p>
                    <p>Condition: <?= htmlspecialchars($animal['AnimalCondition']) ?></p>

                    <form method="POST" action="../control/DonateToAnimal.php">
                        <input type="hidden" name="animal_id" value="<?= htmlspecialchars($animal['AnimalID']) ?>">
                        <label>Amount:</label>
                        <input type="number" name="amount" required min="1">
                        
                        <label>Concern:</label>
                        <select name="purpose" required>
                            <option value="food">Animal Food</option>
                            <option value="medicine">Medicine</option>
                            <option value="all">All</option>
                            <option value="clothing">Clothing</option>
                            <option value="transport">Transport</option>
                        </select>
                        
                        <button class="btn" type="submit">Donate</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- GENERAL FUND -->
        <h3>General Fund Donations</h3>
        <p>Make a one-time or recurring donation to support all animals and activities.</p>
        <form id="general-donation-form" method="POST" action="../control/DonateToGeneralFund.php">
            <label for="general-amount">Amount:</label>
            <input type="number" id="general-amount" name="amount" required min="1">

            <label for="donation-type">Donation Type:</label>
            <select id="donation-type" name="donation_type" required>
                <option value="One-time">One-time</option>
                <option value="Monthly">Monthly</option>
            </select>

            <button type="submit" class="btn">Submit Donation</button>
        </form>

        <div id="message" style="display: none;"></div>
</section>


<script src="../js/ShowDetailHomepage.js"></script>

<?php include '../includes/footer.php'; ?>