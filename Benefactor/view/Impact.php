<?php
include '../includes/navbar.php'; 
?>

<main>
<section id="impact" class="container-fluid py-4">
    <h2>See the Impact of Your Donations</h2>
    <p>Stay connected with the causes you support. View updates, success stories, and the outcomes of your generous contributions.</p>

    <?php if (!empty($donations)): ?>
      <div class="my-5">
        <h3>Your Donation History</h3>
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Date</th>
                  <th>Amount</th>
                  <th>Donated To</th>
                  <th>Purpose</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($donations as $donation): ?>
                    <tr>
                        <td><?= date('M j, Y', strtotime($donation['DonationDate'])) ?></td>
                        <td>$<?= htmlspecialchars(number_format($donation['DonationAmount'], 2)) ?></td>
                        <td>
                            <?php 
                                if (!empty($donation['CampaignName'])) {
                                    echo htmlspecialchars($donation['CampaignName']);
                                } elseif (!empty($donation['AnimalName'])) {
                                    echo 'Sponsorship for ' . htmlspecialchars($donation['AnimalName']);
                                } else {
                                    echo 'General Fund';
                                }
                            ?>
                        </td>
                        <td><?= htmlspecialchars($donation['Purpose'] ?? 'N/A') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="my-5">
        <h3>Animals You've Helped</h3>
        <div class="grid-container">
            <?php
                // Collect unique animals from your donations to avoid duplicates
                $uniqueAnimals = [];
                foreach ($donations as $donation) {
                    if (!empty($donation['AnimalID']) && !isset($uniqueAnimals[$donation['AnimalID']])) {
                        $uniqueAnimals[$donation['AnimalID']] = $donation;
                    }
                }
            ?>

            <?php if (!empty($uniqueAnimals)): ?>
                <?php foreach ($uniqueAnimals as $animal): ?>
                    <div class="animal-card">
                        <div class="animal-image-container">
                            <img src="../../Main/<?= htmlspecialchars($animal['PicturePath']) ?>" alt="<?= htmlspecialchars($animal['AnimalName']) ?>">
                        </div>
                        <div class="animal-card-body">
                            <h4><?= htmlspecialchars($animal['AnimalName']) ?></h4>
                            <p>
                                <strong>Species:</strong> <?= htmlspecialchars($animal['AnimalSpecies']) ?><br>
                                <strong>Breed:</strong> <?= htmlspecialchars($animal['AnimalBreed']) ?><br>
                                <strong>Age:</strong> <?= htmlspecialchars($animal['AnimalAge']) ?> years
                            </p>
                            <?php if (!empty($animal['AnimalCondition'])): ?>
                                <p><strong>Condition:</strong> <span class="animal-condition"><?= htmlspecialchars($animal['AnimalCondition']) ?></span></p>
                            <?php endif; ?>
                            <div class="mt-auto"> <span class="badge bg-success fs-6">
                                Status: <?= htmlspecialchars($animal['AdoptionStatus']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>You haven't sponsored any specific animals yet. Your donations to campaigns and the general fund are still making a huge difference!</p>
            <?php endif; ?>
        </div>
    </div>
    <?php else: ?>
        <p class="mt-5">You have not made any donations yet. Visit our 'Donate' page to make your first contribution!</p>
    <?php endif; ?>

</section>
</main>

<?php include '../includes/footer.php'; ?>
