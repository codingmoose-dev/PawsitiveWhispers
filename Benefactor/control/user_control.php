<?php
include '../model/user_model.php';

// Initialize the model
$userModel = new UserModel('localhost', 'root', '', 'PawsitiveWellbeing');

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete benefactor functionality
    if (isset($_POST['delete_benefactor'])) {
        $id = intval($_POST['id']); // Use ID as the unique identifier
        $success = $userModel->deleteBenefactorById($id);
        
        if ($success) {
            echo "Benefactor with ID $id has been deleted successfully.";
        } else {
            echo "Error deleting benefactor with ID $id.";
        }
    }
}

// Fetch all benefactors to display
$benefactors = $userModel->fetchBenefactorsFromDatabase();

// Include the view
require '../view/view_user.php';

// Close the connection
$userModel->closeConnection();
?>
