<?php
require_once '../model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login($emailOrId, $password) {
        // Authenticate user
        $user = $this->userModel->authenticateUser($emailOrId, $password);

        if ($user) {
            // Start session and store user information
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user'] = $user;

            // Redirect to homepage or user-specific page
            header("Location: ../view/Homepage.php");
            exit();
        } else {
            // Log the failure and redirect
            error_log("Authentication failed for user: $emailOrId");
            header("Location: ../view/SignIn.php?error=invalid");
            exit();
        }
    }
}
?>
