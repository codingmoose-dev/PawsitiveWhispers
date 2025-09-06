<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Volunteer') {
    header("Location: /PawsitiveWhispers/Main/view/SignIn.php?error=unauthorized");
    exit();
}

include '../control/TrainingLibraryController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Volunteer Training Library</title>
    <link rel="stylesheet" href="../css/Style.css">
</head>
<body>
    <header>
        <h1>Volunteer Training & Stories</h1>
        <p>Access helpful resources and inspiring stories shared by vets and fellow volunteers.</p>
    </header>

    <section id="training-list">
        <?php if (!empty($contentList)): ?>
            <div class="training-items">
                <?php foreach ($contentList as $item): ?>
                    <div class="training-card">
                        <h2><?= htmlspecialchars($item['Title']) ?> (<?= $item['ContentType'] ?>)</h2>
                        <p><strong>Uploaded by:</strong> <?= htmlspecialchars($item['Uploader']) ?></p>
                        <p><?= nl2br(htmlspecialchars($item['Description'])) ?></p>
                        <?php if (!empty($item['VideoPath'])): ?>
                            <video width="100%" controls>
                                <source src="<?= htmlspecialchars($item['VideoPath']) ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        <?php endif; ?>
                        <p><em>Uploaded on: <?= date('F j, Y', strtotime($item['UploadDate'])) ?></em></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No training content available at the moment.</p>
        <?php endif; ?>
    </section>
</body>
</html>
