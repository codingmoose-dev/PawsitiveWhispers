<?php
require_once '../control/SignInController.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailOrId = $_POST['email_or_id'];
    $password = $_POST['password'];

    // Instantiate the controller and call the login method
    $userController = new UserController();
    $userController->login($emailOrId, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - PawsitiveWellbeing</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 40px;
            background-color: white;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 70%;
            max-width: 1000px;
        }

        .form-container {
            max-width: 400px;
            width: 100%;
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            color: #2c3e50;
        }

        .logo-container img {
            height: 300px;
        }

        form input, form button {
            display: block;
            margin: 10px 0;
            width: 100%;
            padding: 10px;
            font-size: 1.1em;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form button {
            background-color: #3498db;
            color: white;
            cursor: pointer;
            border: none;
            font-size: 1.1em;
        }

        form button:hover {
            background-color: #2980b9;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: #3498db;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            position: absolute;
            bottom: 0;
        }

        .error-message {
            color: red;
            font-family: Arial, sans-serif;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <img src="../images/PrimaryLogo.png" alt="PawsitiveWellbeing Logo">
        </div>

        <div class="form-container">
            <h1>Sign In</h1>
            <form id="sign-in-form" action="" method="POST">
                <input type="text" name="email_or_id" placeholder="Enter your Email or ID" required>
                <input type="password" name="password" placeholder="Enter your Password" required>
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
        © 2025 PawsitiveWellbeing. All rights reserved.
    </footer>
</body>
</html>
