<?php
include '../model/VolunteerModel.php'; 

class VolunteerController {
    private $volunteermodel;

    public function __construct() {
        $this->volunteermodel = new VolunteerModel();
    }

    public function register() {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize the input data
            $fullName = htmlspecialchars($_POST['full_name']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $phone = htmlspecialchars($_POST['phone']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $homeAddress = htmlspecialchars($_POST['home_address']);
            $cityStateCountry = htmlspecialchars($_POST['city_state_country']);
            $locationEnabled = isset($_POST['location_enabled']) && $_POST['location_enabled'] == 'Yes' ? true : false;
            $emergencyRescue = isset($_POST['emergency_rescue']) && $_POST['emergency_rescue'] == 'yes' ? true : false;
            $organizeCampaigns = isset($_POST['organize_campaigns']) && $_POST['organize_campaigns'] == 'yes' ? true : false;
            $manageAdoption = isset($_POST['manage_adoption']) && $_POST['manage_adoption'] == 'yes' ? true : false;
            $skills = htmlspecialchars($_POST['skills']);
            $experienceYears = (int)$_POST['experience_years'];
            $availability = $_POST['availability'];

            if ($this->volunteermodel->registerVolunteer($fullName, $email, $phone, $password, $homeAddress, $cityStateCountry, $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, $experienceYears, $availability)) {
                // Set success message and redirect
                session_start();
                $_SESSION['registration_success'] = true;
                header('Location: ../view/VolunteerHomepage.php');
                exit();
            } else {
                return "Registration failed. Please try again.";
            }
        }
    }
}

$volunteerController = new VolunteerController();
$volunteerController->register();
?>
