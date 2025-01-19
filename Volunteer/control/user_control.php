<?php
include_once '../model/user_model.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }
    
    public function displayUsers() {
        $users = $this->userModel->getAllUsers();
        include '../view/view_user.php';  // Pass the data to the view
    }

    public function updateUser($userId, $fullName, $email, $phone, $password = null, $homeAddress, $cityStateCountry, $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, $experienceYears, $availability) {
        if ($password !== null) {
            $this->userModel->updateUser($userId, $fullName, $email, $phone, $password, $homeAddress, $cityStateCountry, $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, $experienceYears, $availability);
        } else {
            $this->userModel->updateUser($userId, $fullName, $email, $phone, null, $homeAddress, $cityStateCountry, $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, $experienceYears, $availability);
        }

        header('Location: ../view/view_user.php?success=update');
    }

    // Handle requests (POST for update or GET for displaying users)
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
            // Filter and sanitize input data based on form element IDs
            $userId = filter_var($_POST['user_id'], FILTER_VALIDATE_INT);
            $fullName = htmlspecialchars(trim($_POST['FullName']));
            $email = htmlspecialchars(trim($_POST['Email']));
            $phone = htmlspecialchars(trim($_POST['Phone']));
            $password = isset($_POST['Password']) ? htmlspecialchars(trim($_POST['Password'])) : null;
            $homeAddress = htmlspecialchars(trim($_POST['HomeAddress']));
            $cityStateCountry = htmlspecialchars(trim($_POST['CityStateCountry']));
            $locationEnabled = isset($_POST['LocationEnabled']) ? true : false;
            $emergencyRescue = isset($_POST['EmergencyRescue']) ? true : false;
            $organizeCampaigns = isset($_POST['OrganizeCampaigns']) ? true : false;
            $manageAdoption = isset($_POST['ManageAdoption']) ? true : false;
            $skills = htmlspecialchars(trim($_POST['Skills']));
            $experienceYears = filter_var($_POST['ExperienceYears'], FILTER_VALIDATE_INT);
            $availability = htmlspecialchars(trim($_POST['Availability']));

            // Validate required fields
            if ($userId !== false && !empty($fullName) && !empty($email)) {
                // Call updateUser method with the sanitized data
                $this->updateUser($userId, $fullName, $email, $phone, $password, $homeAddress, $cityStateCountry, $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, $experienceYears, $availability);
            } else {
                // Redirect with an error if validation fails
                header('Location: ../view/view_user.php?error=invalid_input');
            }
        } else {
            // Display the user list
            $this->displayUsers();
        }
    }
}
?>
