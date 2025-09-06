<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawsitiveWhispers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/Style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="Homepage.php">
                <img src="../../Main/images/Icon.png" alt="PawsitiveWhispers Logo" class="navbar-logo">
                <span class="fs-4">Pawsitive Whispers</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                        $pages = [
                            'home'         => ['url' => 'Homepage.php', 'text' => 'Home'],
                            'donate'       => ['url' => 'Donate.php', 'text' => 'Donate'],
                            'adoption'     => ['url' => 'Adoption.php', 'text' => 'Adopt an Animal'],
                            'impact'       => ['url' => 'DonationImpact.php', 'text' => 'Impact & Updates'],
                            'transparency' => ['url' => 'Transparency.php', 'text' => 'Transparency'],
                            'faq'          => ['url' => 'FAQs.php', 'text' => 'Frequently Asked Questions']
                        ];

                        foreach ($pages as $pageKey => $pageData) {
                            $isActive = ($activePage == $pageKey) ? 'active' : '';
                            echo '<li class="nav-item">
                                    <a class="nav-link ' . $isActive . '" href="' . $pageData['url'] . '">' . $pageData['text'] . '</a>
                                  </li>';
                        }
                    ?>
                    <li class="nav-item">
                        <form action="/PawsitiveWhispers/Main/view/Logout.php" method="post" class="d-inline">
                            <button type="submit" class="nav-link btn btn-link">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>