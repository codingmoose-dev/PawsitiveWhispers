<?php
require_once '../model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        // Initialize UserModel (no parameters required now)
        $this->userModel = new UserModel();
    }

    public function SignIn($email, $password) {
        $user = $this->userModel->findUserByEmail($email);
    
        if ($user) {
            if (password_verify($password, $user['Password'])) {
                // Debug output
                error_log("User email: $email, User table: {$user['table']}");
    
                switch ($user['table']) {
                    case 'GeneralUsers':
                        header("Location: ../../General User/view/GeneralUserHomepage.php");
                        break;
                    case 'Volunteers':
                        header("Location: ../../Volunteer/view/VolunteerHomepage.php");
                        break;
                    case 'Veterinarians':
                        header("Location: ../../Veterinarian/view/VeterinarianHomepage.php");
                        break;
                    case 'Benefactors':
                        header("Location: ../../Benefactor/view/BenefactorHomepage.php");
                        break;
                    default:
                        header("Location: ../view/ErrorPage.php");
                        break;
                }
                exit();
            } else {
                header("Location: ../view/SignInPage.php?error=invalid");
                exit();
            }
        } else {
            header("Location: ../view/SignInPage.php?error=invalid");
            exit();
        }
    }  
}
