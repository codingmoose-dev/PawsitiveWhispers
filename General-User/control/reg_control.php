<?php
session_start();
include_once '../model/user_model.php'; 

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel(); 
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return "Invalid request method.";
        }

        // Collect and sanitize form data
        $fullName = trim($_POST['FullName'] ?? '');
        $email = filter_var($_POST['Email'] ?? '', FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST['Phone'] ?? '');
        $password = $_POST['Password'] ?? '';
        $address = trim($_POST['Address'] ?? '');
        $cityStateCountry = trim($_POST['CityStateCountry'] ?? '');
        $locationEnabled = isset($_POST['Location']) && $_POST['Location'] === 'Yes' ? 1 : 0;
        $adoptionNotifications = isset($_POST['AdoptionNotifications']) && $_POST['AdoptionNotifications'] === 'Yes' ? 1 : 0;
        $donationCampaigns = isset($_POST['DonationCampaigns']) && $_POST['DonationCampaigns'] === 'Yes' ? 1 : 0;
        $newsletterSubscription = isset($_POST['NewsletterSubscription']) && $_POST['NewsletterSubscription'] === 'Yes' ? 1 : 0;
        $socialMediaLink = trim($_POST['SocialMediaLinks'] ?? '');
        $emailVerified = isset($_POST['EmailVerification']) ? 1 : 0;

        // Validation for required fields
        if (empty($fullName)) {
            return "Full name is required.";
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format.";
        }
        
        if (empty($phone)) {
            return "Phone number is required.";
        }
        
        if (empty($password) || strlen($password) < 6) {
            return "Password is required and must be at least 6 characters long.";
        }

        // Validate file upload (if provided)
        $profilePicturePath = '';
        if (!empty($_FILES['ProfilePicture']['name']) && $_FILES['ProfilePicture']['error'] === UPLOAD_ERR_OK) {
            $profilePictureTempPath = $_FILES['ProfilePicture']['tmp_name'];
            $profilePictureName = basename($_FILES['ProfilePicture']['name']);
            $targetDirectory = "../files";
            $targetPath = $targetDirectory . DIRECTORY_SEPARATOR . $profilePictureName;

            // Check if the file is an image
            $fileType = mime_content_type($profilePictureTempPath);
            if (strpos($fileType, 'image') === false) {
                return "Profile picture must be an image.";
            }

            if (move_uploaded_file($profilePictureTempPath, $targetPath)) {
                $profilePicturePath = $targetPath;
            } else {
                return "Error uploading the profile picture.";
            }
        }

        // Call the model function to register the user
        $registrationStatus = $this->model->registerUser(
            $fullName, $email, $phone, $password, $address, $cityStateCountry,
            $locationEnabled, $adoptionNotifications, $donationCampaigns, $newsletterSubscription,
            $profilePicturePath, $socialMediaLink, $emailVerified
        );

        if ($registrationStatus === true) {
            $_SESSION['registration_success'] = true;
            header("Location: ../view/GeneralUserHomepage.php"); // Redirect to homepage
            exit(); // Stop further execution
        } else {
            return "Registration failed: " . htmlspecialchars($registrationStatus);
        }
    }
}

// Process registration only if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();
    echo $userController->register();
}
?>
