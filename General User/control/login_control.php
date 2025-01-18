<?php
// Include the user model
include_once('../model/user_model.php');

// Check if login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    // Call getUserByEmail function from the model to get the user record by email
    $user = getUserByEmail($email);

    if ($user && password_verify($password, $user['Password'])) {
        // Password matches, login successful, start session
        session_start();
        $_SESSION['user'] = $user;
        header("Location: http://localhost/PawsitiveWellbeing/index.php"); // Redirect to index.php
        exit();
    } else {
        // Invalid credentials
        echo "Invalid email or password.";
    }
}
?>
