<?php
include '../control/AdoptionController.php';

// Initialize the controller and fetch available animals
$animalController = new AnimalController();
$availableAnimals = $animalController->getAvailableAnimals();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt an Animal</title>
    <link rel="stylesheet" href="../css/AdoptionStyle.css">
</head>
<body>
    <header>
        <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
            <img src="../images/Icon.png" alt="PawsitiveWellbeing Logo" style="height: 60px;">
            <h1>Adopt an Animal</h1>  
        </div>
    </header>

    <section id="adoption">
    <h2>Available Animals</h2>

    <!-- Grid container for the cards -->
    <?php $availableAnimals = $animalController->getAvailableAnimals(); ?>
    <?php if (isset($availableAnimals) && !empty($availableAnimals)): ?>
        <div class="grid-container">
            <?php foreach ($availableAnimals as $animal): ?>
                <div class="animal-card">
                    <img src="../../Main/<?php echo $animal['PicturePath']; ?>.jpg" alt="<?php echo $animal['Name']; ?>" class="animal-image">
                    <h3><?php echo $animal['Name']; ?></h3>
                    <p>Species: <?php echo $animal['Species']; ?></p>
                    <p>Breed: <?php echo $animal['Breed']; ?></p>
                    <p>Age: <?php echo $animal['Age']; ?> years</p>
                    <p>Gender: <?php echo $animal['Gender']; ?></p>
                    <p>Condition: <?php echo $animal['AnimalCondition']; ?></p>
                    <button>Adopt Me</button>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No animals are available for adoption at the moment.</p>
    <?php endif; ?>
</section>


    <footer>
        <p>© 2024 PawsitiveWellbeing | All Rights Reserved</p>
    </footer>
</body>
</html>
