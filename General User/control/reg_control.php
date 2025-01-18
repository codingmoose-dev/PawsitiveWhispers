<?php
// Database connection
include_once '../model/user_model.php'; // Assuming db_config.php has the database connection code

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
            $locationenabled = isset($_POST['LocationEnabled']) ? 1 : 0; // Checkbox
            $adoptionNotifications = isset($_POST['AdoptionNotifications']) ? 1 : 0; // Checkbox
            $donationCampaigns = isset($_POST['DonationCampaigns']) ? 1 : 0; // Checkbox
            $newsletterSubscription = isset($_POST['NewsletterSubscription']) ? 1 : 0; // Checkbox
            $socialMediaLinks = $_POST['SocialMediaLinks'];
            $emailVerified = isset($_POST['EmailVerified']) ? 1 : 0; // Checkbox

            // File upload handling
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
                        // Error moving the file
                        echo "Error uploading the profile picture.";
                        return;
                    }
                } else {
                    // Invalid image file
                    echo "The uploaded file is not an image.";
                    return;
                }
            } else {
                // No file uploaded or error occurred
                echo "No profile picture uploaded or an error occurred.";
                // Optionally, set $profilePicturePath to a default value
                $profilePicturePath = ''; // Or a default image path
            }

            // Hash the password before saving it to the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare the SQL query to insert user data
            global $conn; // Database connection
            $stmt = $conn->prepare("INSERT INTO GeneralUsers (FullName, Email, Phone, Password, Address, CityStateCountry, LocationEnabled, AdoptionNotifications, DonationCampaignNotifications, NewsletterSubscription, ProfilePicturePath, SocialMediaLinks, EmailVerified) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssssssss", $fullName, $email, $phone, $hashedPassword, $address, $cityStateCountry, $locationenabled, $adoptionNotifications, $donationCampaigns, $newsletterSubscription, $profilePicturePath, $socialMediaLinks, $emailVerified);

            // Execute the query and check if it was successful
            if ($stmt->execute()) {
                echo "User registered successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }
}

// Instantiate the controller and call the register method
$controller = new UserController();
$controller->register();
?>
