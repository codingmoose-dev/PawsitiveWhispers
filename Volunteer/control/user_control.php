<?php
// Include the UserModel file
require_once '../model/user_model.php'; // Adjust the path as needed
// Instantiate the UserModel
$userModel = new UserModel();

// Retrieve data if needed
$connection = $userModel->getConnection();

// Optionally pass the model or data to the view
include '../view/view_user.php';

class UserController {
    private $userModel;

    public function __construct() {
        // Initialize the model
        $this->userModel = new UserModel();
    }

    public function handleRequest() {
        // Check if the form is submitted for updating user data
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
            $this->updateUser();
        }
    }

    private function updateUser() {
        // Collect user input from the form
        $userId = $_POST['user_id'];
        $fullName = $_POST['FullName'];
        $email = $_POST['Email'];
        $phone = $_POST['Phone'];
        $password = $_POST['Password'];
        $homeAddress = $_POST['HomeAddress'];
        $cityStateCountry = $_POST['CityStateCountry'];
        $locationEnabled = isset($_POST['LocationEnabled']) ? 1 : 0;
        $emergencyRescue = isset($_POST['EmergencyRescue']) ? 1 : 0;
        $organizeCampaigns = isset($_POST['OrganizeCampaigns']) ? 1 : 0;
        $manageAdoption = isset($_POST['ManageAdoption']) ? 1 : 0;
        $skills = $_POST['Skills'];
        $experienceYears = $_POST['ExperienceYears'];
        $availability = $_POST['Availability'];

        // Update user data in the database
        $updateQuery = "UPDATE Volunteers SET FullName=?, Email=?, Phone=?, Password=?, HomeAddress=?, CityStateCountry=?, LocationEnabled=?, EmergencyRescue=?, OrganizeCampaigns=?, ManageAdoption=?, Skills=?, ExperienceYears=?, Availability=? WHERE VolunteerID=?";

        // Prepare the SQL statement
        if ($stmt = $this->userModel->getConnection()->prepare($updateQuery)) {
            // Bind parameters
            $stmt->bind_param(
                'ssssssiiiiissi',
                $fullName,
                $email,
                $phone,
                $password,
                $homeAddress,
                $cityStateCountry,
                $locationEnabled,
                $emergencyRescue,
                $organizeCampaigns,
                $manageAdoption,
                $skills,
                $experienceYears,
                $availability,
                $userId
            );

            // Execute the query
            if ($stmt->execute()) {
                // Redirect with a success message and trigger the refresh
                header('Location: view_user.php?success=update');
                exit();
            } else {
                // Redirect with an error message
                header('Location: view_user.php?error=true');
                exit();
            }
        } else {
            // Redirect with an error if the statement could not be prepared
            header('Location: view_user.php?error=true');
            exit();
        }

    }
}
?>
