<?php
include '../model/BenefactorModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new BenefactorModel();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['delete_benefactor'])) {
                $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
                if ($id === false) {
                    header('Location: ../view/view_user.php?error=invalid_id');
                    exit();
                }

                // Directly calling the deleteUser method
                $success = $this->userModel->deleteUser($id);
                if ($success) {
                    header('Location: ../view/view_user.php?success=delete');
                } else {
                    header('Location: ../view/view_user.php?error=delete');
                }
                exit();
            }
        }
    }
}

// Initialize the controller
$userController = new UserController();

// Handle the request (this will process any delete actions)
$userController->handleRequest();
?>