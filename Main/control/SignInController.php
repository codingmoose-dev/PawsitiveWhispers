<?php
require_once '../model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // SignIn method to authenticate the user
    public function SignIn($email, $password) {
        $user = $this->userModel->findUserByEmail($email, $password);

        if ($user) {
            // Log the successful sign-in
            error_log("User email: $email, User table: {$user['table']}");

            // Redirect based on the user's table
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
            // Log when no user is found or password mismatch
            error_log("Invalid login attempt for email: $email");
            header("Location: ../view/SignIn.php?error=invalid");
            exit();
        }
    }
}
?>
