<?php
session_start();

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
    <title>Donate - PawsitiveWellbeing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
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
            <button id="show-more-donate" class="btn">Show Campaigns</button>

            <div id="donate-more-content" style="display:none; margin-top: 20px; padding: 20px; background-color: #f4f4f4; border-radius: 8px;">
                <div id="campaigns">
                    <?php if (!empty($campaigns)): ?>
                        <table>
                            <thead>
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
                            </thead>
                            <tbody>
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
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No campaigns available at this time.</p>
                    <?php endif; ?>
                </div>

                <form id="donation-form-campaign" method="POST" action="../control/DonateToCampaign.php" class="form">
                    <h4>Donate to a Campaign</h4>
                    <div class="form-group">
                        <input type="number" name="campaign_id" placeholder="Campaign ID" required />
                    </div>
                    <div class="form-group">
                        <input type="number" name="amount" placeholder="Donation Amount" required min="1" />
                    </div>
                    <div class="form-group">
                        <select name="donation_type" required>
                            <option value="" disabled selected>Donation Type</option>
                            <option value="One-time">One-time</option>
                            <option value="Monthly">Monthly</option>
                        </select>
                    </div>
                    <button class="btn" type="submit">Donate</button>
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
                        <img src="../../Main/<?= htmlspecialchars($animal['PicturePath']) ?>" alt="<?= htmlspecialchars($animal['Name']) ?>" />
                        <h4><?= htmlspecialchars($animal['Name']) ?></h4>
                        <p>Species: <?= htmlspecialchars($animal['Species']) ?></p>
                        <p>Breed: <?= htmlspecialchars($animal['Breed']) ?></p>
                        <p>Age: <?= htmlspecialchars($animal['Age']) ?> years</p>
                        <p>Condition: <?= htmlspecialchars($animal['AnimalCondition']) ?></p>

                        <form method="POST" action="../control/DonateToAnimal.php" class="form">
                            <input type="hidden" name="animal_id" value="<?= htmlspecialchars($animal['AnimalID']) ?>" />
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" name="amount" required min="1" />
                            </div>
                            <div class="form-group">
                                <label>Concern</label>
                                <select name="purpose" required>
                                    <option value="food">Animal Food</option>
                                    <option value="medicine">Medicine</option>
                                    <option value="all">All</option>
                                    <option value="clothing">Clothing</option>
                                    <option value="transport">Transport</option>
                                </select>
                            </div>
                            <button class="btn btn-outline" type="submit">Donate</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- General Fund -->
        <div class="section-block">
            <h3>General Fund Donations</h3>
            <p>Make a one-time or monthly donation to support all animals and ongoing activities.</p>
            <form id="general-donation-form" method="POST" action="../control/DonateToGeneralFund.php" class="form">
                <div class="form-group">
                    <label for="general-amount">Amount</label>
                    <input type="number" id="general-amount" name="amount" required min="1" />
                </div>
                <div class="form-group">
                    <label for="donation-type">Donation Type</label>
                    <select id="donation-type" name="donation_type" required>
                        <option value="One-time">One-time</option>
                        <option value="Monthly">Monthly</option>
                    </select>
                </div>
                <button type="submit" class="btn">Submit Donation</button>
            </form>
        </div>
    </div>
</section>

<script src="../js/ShowDetailHomepage.js"></script>
<?php include '../includes/footer.php'; ?>
</body>
</html>
