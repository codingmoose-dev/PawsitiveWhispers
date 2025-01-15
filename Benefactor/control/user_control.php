<?php
include 'user_model.php';

// Initialize the model
$userModel = new UserModel('localhost', 'root', '', 'pawsitivewellbeing');

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete user functionality
    if (isset($_POST['delete_user'])) {
        $userId = intval($_POST['user_id']);
        $success = $userModel->deleteUser($userId);
        
        if ($success) {
            echo "User with ID $userId has been deleted successfully.";
        } else {
            echo "Error deleting user with ID $userId.";
        }
    }
}

// Fetch all users to display
$users = $userModel->getAllUsers();

// Include the view
require 'user_view.php';

// Close the connection
$userModel->closeConnection();
?>
