<?php
include '../control/HomepageDisplayRequests.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Impact</title>
    <link rel="stylesheet" href="../css/Style.css">
</head>
<body>
    <header>
        <h1>Donation Impact</h1>
        <p>See the impact of your donations and the campaigns you've supported.</p>
    </header>

    <section id="impact">
        <!-- Form to enter Benefactor ID -->
        <form method="post" action="">
            <label for="benefactor_id">Enter your Benefactor ID:</label>
            <input type="number" name="benefactor_id" id="benefactor_id" >
            <button type="submit" class="btn">Submit</button>
        </form>

        <!-- Check if donations data is available -->
        <?php if (isset($donations) && !empty($donations)): ?>
            <h2>Your Donations</h2>
            <table>
                <tr>
                    <th>Donation Amount</th> 
                    <th>Campaign Name</th>
                    <th>Donation Date</th>
                </tr>
                <?php foreach ($donations as $donation): ?>
                    <tr>
                        <td><?php echo $donation['DonationAmount']; ?></td>
                        <td><?php echo $donation['CampaignName']; ?></td>
                        <td><?php echo $donation['DonationDate']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <h3>Animals Benefited</h3>
            <div class="grid-container">
                <?php foreach ($donations as $donation): ?>
                    <div class="animal-card">
                        <img src="../../Main/<?php echo $donation['PicturePath']; ?>.jpg" alt="<?php echo $donation['AnimalName'];?>" class = "animal-image">
                        <h4><?php echo $donation['AnimalName']; ?></h4>
                        <p>Species: <?php echo $donation['AnimalSpecies']; ?></p>
                        <p>Breed: <?php echo $donation['AnimalBreed']; ?></p>
                        <p>Age: <?php echo $donation['AnimalAge']; ?> years</p>
                        <p>Condition: <?php echo $donation['AnimalCondition']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No donations found for this Benefactor ID.</p>
        <?php endif; ?>
    </section>

    <footer>
        <p>© 2024 PawsitiveWellbeing | All Rights Reserved</p>
    </footer>
</body>
</html>
