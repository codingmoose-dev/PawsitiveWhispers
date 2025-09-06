<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PawsitiveWhispers</title>
  <link rel="stylesheet" href="../css/Style.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center gap-2" href="Homepage.php">
        <img src="../../Main/images/Icon.png" alt="PawsitiveWhispers Logo" class="navbar-logo">
        <span class="fs-4">PawsitiveWhispers</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <?php
            $pages = [
              'home' => 'Homepage.php',
              'donate' => 'Donate.php',
              'adoption' => 'Adoption.php',
              'impact' => 'DonationImpact.php',
              'transparency' => 'Transparency.php',
              'faq' => 'FAQs.php'
            ];

            foreach ($pages as $page => $link) {
              echo '<li class="nav-item">
                      <a class="nav-link ' . (($activePage == $page) ? 'active' : '') . '" href="' . $link . '">' . ucfirst($page) . '</a>
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
</body>
</html>