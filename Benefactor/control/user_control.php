<?php
include '../model/user_model.php';

class UserController {
    private $userModel;

    public function __construct($servername, $username, $password, $dbname) {
        // Initialize the model with the database connection parameters
        $this->userModel = new UserModel($servername, $username, $password, $dbname);
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['delete_benefactor'])) {
                $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
                
                if ($id === false) {
                    header('Location: view_user.php?error=invalid_id');
                    exit();
                }

                try {
                    $success = $this->userModel->deleteUser($id);

                    if ($success) {
                        header('Location: view_user.php?success=delete');
                    } else {
                        header('Location: view_user.php?error=delete');
                    }
                    exit();
                } catch (Exception $e) {
                    // Catch any error thrown by the delete operation
                    header('Location: view_user.php?error=delete');
                    exit();
                }
            }
        }
    }

    public function fetchBenefactors() {
        // Fetch all benefactors using the model
        return $this->userModel->getAllBenefactors();
    }
}

// Initialize the controller
$userController = new UserController('localhost', 'root', '', 'PawsitiveWellbeing');

// Handle the request
$userController->handleRequest();

// Fetch all benefactors for display
$benefactors = $userController->fetchBenefactors();

// Include the view for rendering
require '../view/view_user.php';
?>
