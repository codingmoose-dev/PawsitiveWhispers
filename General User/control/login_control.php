<?php
// Include the user model
include_once('../model/user_model.php');

// Check if login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    // Call login function from model
    $user = loginUser($email, $password);
    
    if ($user) {
        // Login successful, set session or redirect as needed
        session_start();
        $_SESSION['user'] = $user;
        echo "Login successful!";
        header("Location: dashboard.php"); // Redirect to dashboard
    } else {
        echo "Invalid email or password.";
    }
}
?>
