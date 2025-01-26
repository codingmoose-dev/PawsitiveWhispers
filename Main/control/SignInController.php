<?php
require_once '../model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        // Initialize UserModel (no parameters required now)
        $this->userModel = new UserModel();
    }

    // SignIn method to authenticate the user
    public function SignIn($email, $password) {
        $user = $this->userModel->findUserByEmail($email);

        if ($user) {
            if (password_verify($password, $user['Password'])) {
                // Log the successful sign-in
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
                        header("Location: ../view/Error.php");
                        break;
                }
                exit();
            } else {
                // Log the password mismatch
                error_log("Password mismatch for user: $email");

                header("Location: ../view/SignIn.php?error=invalid");
                exit();
            }
        } else {
            // Log when no user is found
            error_log("No user found with email: $email");

            header("Location: ../view/SignIn.php?error=invalid");
            exit();
        }
    }  
}
?>
