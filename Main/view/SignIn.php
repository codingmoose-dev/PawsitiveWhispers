<?php
include '../control/SignInController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sign In - PawsitiveWellbeing</title>
    <link rel="stylesheet" href="../css/SignInStyle.css" />
</head>
<body>
  <div class="page-wrapper">
    <div class="container">
      <!-- Logo Section -->
      <div class="logo-container">
        <img src="../images/PrimaryLogo.png" alt="PawsitiveWellbeing Logo" />
      </div>

      <!-- Form Section -->
      <div class="form-container">
        <h1>Sign In</h1>

        <!-- Form -->
        <form id="sign-in-form" action="" method="POST">
          <input type="text" name="email" placeholder="Enter your Email" />
          <input type="password" name="password" placeholder="Enter your Password" />
          <button type="submit">Sign In</button>
        </form>

        <!-- Footer Links -->
        <div class="form-footer">
          <p>Don't have an account? <a href="Register.html">Sign Up</a></p>

          <!-- Error Message -->
          <?php if (isset($_GET['error'])): ?>
            <div class="error-message">
              <?php if ($_GET['error'] === 'invalid'): ?>
                <p>Invalid email or password. Please try again.</p>
              <?php elseif ($_GET['error'] === 'empty'): ?>
                <p>Please fill in both email and password.</p>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    
    <!-- Footer -->
    <footer>
      © 2024 PawsitiveWellbeing. All rights reserved.
    </footer>
  </div>
</body>
</html>