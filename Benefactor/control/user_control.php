<?php
session_start();
require_once '../model/BenefactorModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new BenefactorModel();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_benefactor'])) {
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

            if ($id === false || $id <= 0) {
                $_SESSION['error'] = 'Invalid user ID.';
                header('Location: ../view/view_user.php');
                exit();
            }

            $success = $this->userModel->deleteUser($id);

            if ($success) {
                $_SESSION['success'] = 'Benefactor deleted successfully.';
                header('Location: ../view/view_user.php');
            } else {
                $_SESSION['error'] = 'Failed to delete benefactor.';
                header('Location: ../view/view_user.php');
            }
            exit();
        }
    }
}

// Execute the controller
$userController = new UserController();
$userController->handleRequest();