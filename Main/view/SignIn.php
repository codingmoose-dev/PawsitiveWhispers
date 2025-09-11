<?php
include '../control/SignInController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sign In - Pawsitive Whispers</title>
    <link rel="stylesheet" href="/PawsitiveWhispers/Main/css/SignInStyle.css" />
</head>
<body>
  <div class="page-wrapper">
    <div class="container">
      <!-- Logo Section -->
      <div class="logo-container">
        <img src="../images/PrimaryLogo.png" alt="PawsitiveWhispers Logo" />
      </div>

      <!-- Form Section -->
      <div class="form-container">
        <h1>Sign In</h1>

        <!-- Form -->
        <form id="sign-in-form" action="" method="POST">
            <input type="text" name="email" placeholder="Enter your Email" required />
            
            <div class="password-container">
                <input type="password" name="password" id="password-input" placeholder="Enter your Password" required />
                <span id="toggle-password" class="toggle-icon">
                    <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                      <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                      <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                    </svg>
                    <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16" style="display: none;">
                      <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588M5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                      <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z"/>
                    </svg>
                </span>
            </div>
            
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
      © 2024 Pawsitive Whispers. All rights reserved.
    </footer>
  </div>

  <script src="../js/view-password.js"></script>

</body>
</html>