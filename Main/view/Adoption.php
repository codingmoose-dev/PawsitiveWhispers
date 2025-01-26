<?php
include '../control/AdoptionController.php';
// Initialize the controller
$animalController = new AnimalController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt an Animal</title>
    <link rel="stylesheet" href="../css/Style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
            <img src="../images/Icon.png" alt="PawsitiveWellbeing Logo" style="height: 60px;">
            <h1>Adopt an Animal</h1>  
        </div>
    </header>

    <!-- Adoption Section -->
    <section>
        <h2>Find Your New Best Friend</h2>
        <p>Explore animals currently available for adoption and give them a loving home.</p>
        
        <!-- Animal Grid -->
        <?php if (!empty($animals)): ?>
            <div class="grid-container">
                <?php foreach ($animals as $animal): ?>
                    <div class="animal-card">
                        <img src="../images/<?php echo $animal['PicturePath']; ?>.jpg" alt="<?php echo $animal['Name']; ?>">
                        <h3><?php echo $animal['Name']; ?></h3>
                        <p>Species: <?php echo $animal['Species']; ?></p>
                        <p>Breed: <?php echo $animal['Breed']; ?></p>
                        <p>Age: <?php echo $animal['Age']; ?> years</p>
                        <p>Gender: <?php echo $animal['Gender']; ?></p>
                        <p>Condition: <?php echo $animal['AnimalCondition']; ?></p>
                        <p>Rescue Date: <?php echo $animal['RescueDate']; ?></p>
                        <span class="status-badge"><?php echo $animal['AdoptionStatus']; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No animals available for adoption at this time.</p>
        <?php endif; ?>

        <a href="contact.html" class="btn">Contact Us to Start Adoption</a>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2024 PawsitiveWellbeing | All Rights Reserved</p>
    </footer>
</body>
</html>
