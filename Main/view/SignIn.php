<?php
require_once '../control/SignInController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check for empty fields
    if (empty($email) || empty($password)) {
        header("Location: ../view/SignIn.php?error=empty");
        exit;
    }

    // Initialize the controller and process the sign-in
    $userController = new UserController();
    $userController->SignIn($email, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - PawsitiveWellbeing</title>
    <link rel="stylesheet" href="../css/SignInStyle.css">

</head>
<body>
    <div class="container">
        <div class="logo-container">
            <img src="../images/PrimaryLogo.png" alt="PawsitiveWellbeing Logo">
        </div>

        <div class="form-container">
            <h1>Sign In</h1>
            <form id="sign-in-form" action="" method="POST">
                <input type="text" name="email" placeholder="Enter your Email" >
                <input type="password" name="password" placeholder="Enter your Password" >
                <button type="submit">Sign In</button>
            </form>

            <div class="form-footer">
                <p>Don't have an account? <a href="UserCategory.html">Sign Up</a></p>
            </div>

            <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid'): ?>
                <div class="error-message">
                    <p>We couldn't find your account. Please try again.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <footer>
        © 2024 PawsitiveWellbeing. All rights reserved.
    </footer>
</body>
</html>
