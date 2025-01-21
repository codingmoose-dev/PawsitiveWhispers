<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt an Animal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        header, footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        header h1, footer p {
            margin: 0;
        }
        section {
            padding: 20px;
            text-align: center;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        .animal-card {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .animal-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .animal-card h3 {
            margin: 10px 0 0;
        }
        .animal-card p {
            margin: 5px 0;
            color: #555;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            font-size: 0.9em;
        }
        .btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            display: inline-block;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <h1>Adopt an Animal</h1>
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
                        <img src="../images/<?php echo $animal['PicturePath']; ?>" alt="<?php echo $animal['Name']; ?>">
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
