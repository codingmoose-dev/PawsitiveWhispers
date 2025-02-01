<?php
include_once '../model/user_model.php'; 

class UserController {

    public function register() {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Collect form data
            $fullName = $_POST['FullName'];
            $email = $_POST['Email'];
            $phone = $_POST['Phone'];
            $password = $_POST['Password'];
            $address = $_POST['Address'];
            $cityStateCountry = $_POST['CityStateCountry'];
            $locationEnabled = isset($_POST['Location']) && $_POST['Location'] === 'Yes' ? 1 : 0; // Checkbox handling
            $adoptionNotifications = isset($_POST['AdoptionNotifications']) && $_POST['AdoptionNotifications'] === 'Yes' ? 1 : 0;
            $donationCampaigns = isset($_POST['DonationCampaigns']) && $_POST['DonationCampaigns'] === 'Yes' ? 1 : 0;
            $newsletterSubscription = isset($_POST['NewsletterSubscription']) && $_POST['NewsletterSubscription'] === 'Yes' ? 1 : 0;
            $socialMediaLink = $_POST['SocialMediaLinks']; // Corrected to match form name
            $emailVerified = isset($_POST['EmailVerification']) ? 1 : 0; // Checkbox for email verification

            // File upload handling
            $profilePicturePath = '';
            if (isset($_FILES['ProfilePicture']) && $_FILES['ProfilePicture']['error'] === UPLOAD_ERR_OK) {
                // Get file details
                $profilePictureTempPath = $_FILES['ProfilePicture']['tmp_name'];
                $profilePictureName = $_FILES['ProfilePicture']['name'];
                
                // Check if the uploaded file is an image
                $imageSize = getimagesize($profilePictureTempPath);
                if ($imageSize) {
                    // Define the target directory to save the image
                    $targetDirectory = "../files";
                    $targetPath = $targetDirectory . basename($profilePictureName);

                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($profilePictureTempPath, $targetPath)) {
                        // File uploaded successfully, save the path
                        $profilePicturePath = $targetPath;
                    } else {
                        echo "Error uploading the profile picture.";
                        return;
                    }
                } else {
                    echo "The uploaded file is not an image.";
                    return;
                }
            } else {
                // No file uploaded or error occurred
                echo "No profile picture uploaded or an error occurred.";
            }

            // Call the model function to register the user
            $registrationStatus = registerUser(
                $fullName, $email, $phone, $password, $address, $cityStateCountry,
                $locationEnabled, $adoptionNotifications, $donationCampaigns, $newsletterSubscription,
                $profilePicturePath, $socialMediaLink, $emailVerified
            );

            if ($registrationStatus === true) {
                echo "User registered successfully!";
            } else {
                echo $registrationStatus; // Display the error message from the model
            }
        }
    }
}
?>
