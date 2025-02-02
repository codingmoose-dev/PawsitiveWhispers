<?php
include '../control/UserController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinarian Homepage</title>
    <link rel="stylesheet" href="../css/Style.css"></link>
</head>
<body>
    <!-- Header -->
    <header>
        <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
            <img src="../../Main/images/Icon.png" alt="Veterinarian Logo" style="height: 60px;">
            <h1>Educational Resources Coming Soon!</h1>
        </div>
    </header>

    <!-- Home Section -->
    <section id="home">
        <h2>Coming Soon!</h2>
        <p>Your expertise is invaluable in preparing volunteers for critical rescue missions. Share your knowledge and help train them to make a real impact in the field.</p>
    </section>

    <!-- Training Section -->
    <section id="training">
        <h2>Volunteer Training & Educational Resources</h2>
        <p>Equip volunteers with the necessary skills and knowledge through detailed training sessions. Upload essential materials that will guide them through rescue operations and animal care techniques.</p>
        <button id="upload-material" class="btn">Upload Training Material</button>
        <input type="file" id="file-upload" style="display: none;" accept=".pdf,.doc,.mp4,.jpg">
        <div id="training-materials">
            <h3>Available Training Materials</h3>
            <ul id="materials-list">
                <?php
                if (!empty($materials)) {
                    foreach ($materials as $material) {
                        echo "<li><a href='" . htmlspecialchars($material['file_path']) . "' target='_blank'>" . htmlspecialchars($material['file_name']) . "</a></li>";
                    }
                } else {
                    echo "<p>No training materials available.</p>";
                }
                ?>
            </ul>
        </div>
    </section>

    <script>
        document.getElementById('upload-material').addEventListener('click', function() {
            document.getElementById('file-upload').click();
        });
    </script>

    <script src="../js/HomepageContent.js"></script>

</body>
</html>
