<?php
session_start();
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
            $fullName = htmlspecialchars($_POST['FullName']);
            $email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
            $phone = htmlspecialchars($_POST['Phone']);
            $password = $_POST['Password'];
            $confirmPassword = $_POST['ConfirmPassword'];
            $homeAddress = htmlspecialchars($_POST['HomeAddress']);
            $cityStateCountry = htmlspecialchars($_POST['CityStateCountry']);
            $locationEnabled = isset($_POST['LocationEnabled']) && $_POST['LocationEnabled'] == 'Yes' ? true : false;
            $emergencyRescue = isset($_POST['EmergencyRescue']) && $_POST['EmergencyRescue'] == 'Yes' ? true : false;
            $organizeCampaigns = isset($_POST['OrganizeCampaigns']) && $_POST['OrganizeCampaigns'] == 'Yes' ? true : false;
            $manageAdoption = isset($_POST['ManageAdoption']) && $_POST['ManageAdoption'] == 'Yes' ? true : false;
            $skills = htmlspecialchars($_POST['Skills']);
            $experienceYears = (int)$_POST['ExperienceYears'];
            $availability = $_POST['Availability'];

            if ($this->volunteermodel->registerVolunteer($fullName, $email, $phone, $password, $homeAddress, $cityStateCountry, $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, $experienceYears, $availability)) {
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
