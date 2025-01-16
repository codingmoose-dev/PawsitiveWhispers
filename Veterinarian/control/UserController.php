<?php
require_once __DIR__ . '/../model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel("localhost", "root", "", "PawsitiveWellbeing");
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'viewCombined';

        try {
            switch ($action) {
                case 'viewCombined':
                    $this->viewCombinedPage();
                    break;
                case 'viewById':
                    $this->viewUserByPrimaryKey($_GET['id'] ?? null);
                    break;
                default:
                    $this->viewCombinedPage();
            }
        } catch (Exception $e) {
            $this->handleError($e->getMessage());
        }
    }

    // Displays all users
    public function viewCombinedPage() {
        $users = $this->userModel->getAllUsers();
        require '../view/UserDetailView.php'; // Pass data to the view
    }

    // Displays details for a specific user
    public function viewUserByPrimaryKey($id) {
        if (!$id || !is_numeric($id)) {
            throw new Exception("Invalid ID.");
        }

        $selectedUser = $this->userModel->getUserByPrimaryKey($id);
        if (!$selectedUser) {
            throw new Exception("User not found.");
        }

        require '../view/UserDetailView.php'; // Pass selected user to the view
    }

    private function handleError($errorMessage) {
        // Pass the error message to the view
        require '../view/ErrorView.php'; // Display error view if something goes wrong
    }
    
}

?>
