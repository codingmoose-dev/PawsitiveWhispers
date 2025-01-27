<?php
// Start the session to check for error messages
session_start();

// Check if an error message is set in the URL query parameter (error)
if (isset($_GET['error'])) {
    $error = $_GET['error'];

    // Set a default error message
    $errorMessage = "An unexpected error occurred.";

    // Customize error message based on the error code
    switch ($error) {
        case 'invalid':
            $errorMessage = "Invalid credentials. Please check your email and password.";
            break;
        case 'not_found':
            $errorMessage = "We couldn't find your account. Please try again.";
            break;
        default:
            $errorMessage = "Something went wrong. Please try again later.";
            break;
    }

    // Optionally log the error (useful for debugging)
    error_log("Error: $errorMessage");

    // Display the error message on the page
    echo "<h1>Error: $errorMessage</h1>";
    echo "<p><a href='../view/SignIn.php'>Go back to Sign In</a></p>";
} else {
    // If no error is passed, display a generic error message
    echo "<h1>Unknown Error</h1>";
    echo "<p><a href='../view/SignIn.php'>Go back to Sign In</a></p>";
}
?>
