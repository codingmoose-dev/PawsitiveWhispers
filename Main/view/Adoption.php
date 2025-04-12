<?php
include '../control/AdoptionController.php';
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
        <div class="page-wrapper">
        <header>
            <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                <img src="../images/Icon.png" alt="PawsitiveWellbeing Logo" style="height: 60px;">
                <h1>Available Animals for Adoption</h1>  
            </div>
        </header>

        <section id="adoption">
            <h2>Find Your New Best Friend</h2>
            <p>Explore our available animals for adoption and give them a loving home.</p>
            
            <!-- Search bar for filtering animals -->
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search by name or species..." onkeyup="filterAnimals()">
            </div>
            <!-- Grid container for the cards -->
            <?php $allAnimals = $animalController->getAllAnimals(); ?>
            <?php if (isset($allAnimals) && !empty($allAnimals)): ?>
                <div class="grid-container">
                    <?php foreach ($allAnimals as $animal): ?>
                        <div class="animal-card">
                            <img src="../../Main/<?php echo $animal['PicturePath']; ?>.jpg" alt="<?php echo htmlspecialchars($animal['Name']); ?>" class="animal-image">
                            <h3><?php echo htmlspecialchars($animal['Name']); ?></h3>
                            <p>Species: <?php echo htmlspecialchars($animal['Species']); ?></p>
                            <p>Breed: <?php echo htmlspecialchars($animal['Breed']); ?></p>
                            <p>Age: <?php echo htmlspecialchars($animal['Age']); ?> years</p>
                            <p>Gender: <?php echo htmlspecialchars($animal['Gender']); ?></p>
                            <p>Condition: <?php echo htmlspecialchars($animal['AnimalCondition']); ?></p>
                            
                            <!-- Update button text and color based on the adoption status -->
                            <button class="adopt-btn" data-id="<?php echo $animal['AnimalID']; ?>" 
                                <?php echo ($animal['AdoptionStatus'] === 'Pending') ? 'style="background-color: green; color: white;" disabled' : ''; ?>>
                                <?php echo ($animal['AdoptionStatus'] === 'Pending') ? 'Pending' : 'Adopt Me'; ?>
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            

            <?php else: ?>
                <p>No animals are available for adoption at the moment.</p>
            <?php endif; ?>
        </section>
        </div>

        <footer>
            <p>© 2024 PawsitiveWellbeing | All Rights Reserved</p>
        </footer>
        
        <script src="../js/AnimalProcess.js"></script>

    </body>
</html>