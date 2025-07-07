<?php
session_start();
include '../model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // SignIn method to authenticate the user
    public function SignIn($email, $password) {
        $user = $this->userModel->findUserByEmail($email, $password);

        if ($user) {
            // Store session values
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['user_full_name'] = $user['FullName'];
            $_SESSION['user_role'] = $user['Role'];

            switch ($user['Role']) {
                case 'General':
                    header("Location: ../../General User/view/GeneralUserHomepage.php");
                    break;
                case 'Volunteer':
                    header("Location: ../../Volunteer/view/VolunteerHomepage.php");
                    break;
                case 'Veterinarian':
                    header("Location: ../../Veterinarian/view/VeterinarianHomepage.php");
                    break;
                case 'Benefactor':
                    header("Location: ../../Benefactor/view/BenefactorHomepage.php");
                    break;
                default:
                    header("Location: ../view/SignIn.php?error=role");
                    break;
            }
            exit();
        } else {
            // Invalid login
            header("Location: ../view/SignIn.php?error=invalid");
            exit();
        }
    }
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        header("Location: ../view/SignIn.php?error=empty");
        exit;
    }

    $userController = new UserController();
    $userController->SignIn($email, $password);
}
?>