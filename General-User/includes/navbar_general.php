<?php
if (!isset($activePage)) { $activePage = ''; }
?>
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2" href="../control/GeneralUserController.php">
            <img src="/PawsitiveWhispers/Main/images/Icon.png" alt="Pawsitive Whispers Logo" class="navbar-logo">
            <span class="fs-4">Pawsitive Whispers</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link <?= ($activePage == 'home') ? 'active' : '' ?>" href="../control/GeneralUserController.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Adopt an Animal</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Donate</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Resources</a></li>
                <li class="nav-item">
                    <form action="/PawsitiveWhispers/Main/view/Logout.php" method="post" class="d-inline">
                        <button type="submit" class="nav-link btn btn-link">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>