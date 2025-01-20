<?php
include '../model/usermodel.php';

class UserController {
    private $userModel;

    public function __construct($servername, $username, $password, $dbname) {
        $this->userModel = new UserModel($servername, $username, $password, $dbname);
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['delete_benefactor'])) {
                $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
                if ($id === false) {
                    header('Location: ../view/view_user.php?error=invalid_id');
                    exit();
                }

                try {
                    $success = $this->userModel->deleteUser($id);
                    if ($success) {
                        header('Location: ../view/view_user.php?success=delete');
                    } else {
                        header('Location: ../view/view_user.php?error=delete');
                    }
                    exit();
                } catch (Exception $e) {
                    header('Location: ../view/view_user.php?error=delete');
                    exit();
                }
            }
        }
    }
}

// Initialize the controller
$userController = new UserController('localhost', 'root', '', 'PawsitiveWellbeing');

// Handle the request (this will process any delete actions)
$userController->handleRequest();
?>
