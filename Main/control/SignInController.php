<?php
require_once '../model/UserModel.php';

class UserController {
    private $model;

    // Constructor to initialize the model
    public function __construct() {
        $this->model = new UserModel();
    }

    // Method to handle user sign-in
    public function SignIn($emailOrId, $password) {
        // Check GeneralUsers table
        $user = $this->model->fetchUser('GeneralUsers', 'GeneralUserID', $emailOrId);
        if ($user && password_verify($password, $user['Password'])) {
            header("Location: ../../GeneralUser/view/GeneralUserHomepage.php");
            exit;
        }
    
        // Check Volunteers table
        $user = $this->model->fetchUser('Volunteers', 'VolunteerID', $emailOrId);
        if ($user && password_verify($password, $user['Password'])) {
            header("Location: ../../Volunteer/view/VolunteerHomepage.php");
            exit;
        }
    
        // Check Veterinarians table
        $user = $this->model->fetchUser('Veterinarians', 'VeterinarianID', $emailOrId);
        if ($user && password_verify($password, $user['Password'])) {
            header("Location: ../../Veterinarian/view/VeterinarianHome.php");
            exit;
        }
    
        // Check Benefactors table
        $user = $this->model->fetchUser('Benefactors', 'BenefactorID', $emailOrId);
        if ($user && password_verify($password, $user['Password'])) {
            header("Location: ../../Benefactor/view/BenefactorHomepage.php");
            exit;
        }
    
        // If no user is found or password is invalid, show error
        header("Location: ../view/SignIn.php?error=invalid");
        exit;
    }
}
?>
