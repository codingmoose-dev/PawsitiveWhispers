<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2c3e50;">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center gap-2" href="Homepage.php">
      <img src="../../Main/images/Icon.png" alt="PawsitiveWhispers Logo" style="height: 60px; width: auto;">
      <span class="fs-4">PawsitiveWhispers</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link <?= ($activePage == 'home') ? 'active' : '' ?>" href="Homepage.php">Home</a></li>
        <li class="nav-item"><a class="nav-link <?= ($activePage == 'submitcase') ? 'active' : '' ?>" href="SubmitCase.php">Submit a Case</a></li>
        <li class="nav-item"><a class="nav-link <?= ($activePage == 'adoption') ? 'active' : '' ?>" href="Adoption.php">Adopt an Animal</a></li>
        <li class="nav-item"><a class="nav-link <?= ($activePage == 'donate') ? 'active' : '' ?>" href="Donate.php">Donate</a></li>
        <li class="nav-item"><a class="nav-link <?= ($activePage == 'resources') ? 'active' : '' ?>" href="ResourcesEdu.php">Educational Resources</a></li>
        <li class="nav-item"><a class="nav-link <?= ($activePage == 'faq') ? 'active' : '' ?>" href="FAQs.php">FAQ</a></li>
        <li class="nav-item">
          <form action="/PawsitiveWhispers/Main/view/Logout.php" method="post" class="d-inline">
            <button type="submit" class="nav-link btn btn-link">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>