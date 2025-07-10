<?php
session_start();
require_once '../model/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = new UserModel();

    // Sanitize & Prepare General User Info
    $fullName = htmlspecialchars($_POST['FullName']);
    $email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['Phone']);
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $address = htmlspecialchars($_POST['Address']);
    $city = htmlspecialchars($_POST['City']);
    $state = htmlspecialchars($_POST['State']);
    $country = htmlspecialchars($_POST['Country']);
    $role = $_POST['Role'];
    $cityStateCountry = "$city, $state, $country";
    $socialMediaLinks = htmlspecialchars($_POST['SocialMediaLinks'] ?? '');
    $emailVerified = 0;

    $profilePicturePath = null;
    if (!empty($_FILES['ProfilePicture']['name'])) {
        $fileTmp = $_FILES['ProfilePicture']['tmp_name'];
        $fileName = basename($_FILES['ProfilePicture']['name']);
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($ext, $allowed)) {
            $targetDir = '../uploads/profile_pictures/';
            $safeFullName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $fullName); // Sanitize full name

            // New filename: timestamp_fullname.extension
            $newFileName = time() . '_' . $safeFullName . '.' . $ext;
            $profilePicturePath = $targetDir . $newFileName;

            move_uploaded_file($fileTmp, $profilePicturePath);
        }
    }

    $preferences = [
        'LocationEnabled' => isset($_POST['LocationEnabled']) ? 1 : 0,
        'AdoptionNotifications' => isset($_POST['AdoptionNotifications']) ? 1 : 0,
        'DonationCampaignNotifications' => isset($_POST['DonationCampaignNotifications']) ? 1 : 0,
        'NewsletterSubscription' => isset($_POST['NewsletterSubscription']) ? 1 : 0,
    ];

    // Role-Specific Data
    $volunteer = $veterinarian = $benefactor = [];

    if ($role === 'Volunteer') {
        $volunteer = [
            'LocationEnabled' => isset($_POST['LocationEnabled']) ? 1 : 0,
            'EmergencyRescue' => $_POST['EmergencyRescue'] === 'Yes' ? 1 : 0,
            'OrganizeCampaigns' => $_POST['OrganizeCampaigns'] === 'Yes' ? 1 : 0,
            'ManageAdoption' => $_POST['ManageAdoption'] === 'Yes' ? 1 : 0,
            'Skills' => htmlspecialchars($_POST['Skills']),
            'ExperienceYears' => (int)$_POST['ExperienceYears'],
            'Availability' => $_POST['Availability']
        ];
    }

    if ($role === 'Veterinarian') {
        // Upload files
        $vetLicensePath = $govIDPath = $trainingPath = null;
        $uploadDir = "../uploads/medical-license/";
        $safeFullName = preg_replace('/[^a-zA-Z0-9]/', '', $fullName); // Sanitize full name for file naming
        $timestamp = time();

        if ($_FILES['VetLicensePath']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['VetLicensePath']['name'], PATHINFO_EXTENSION);
            $fileName = "{$timestamp}_{$safeFullName}_VetLicense.{$ext}";
            $vetLicensePath = $uploadDir . $fileName;
            move_uploaded_file($_FILES['VetLicensePath']['tmp_name'], $vetLicensePath);
        }

        if ($_FILES['GovIDPath']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['GovIDPath']['name'], PATHINFO_EXTENSION);
            $fileName = "{$timestamp}_{$safeFullName}_GovtID.{$ext}";
            $govIDPath = $uploadDir . $fileName;
            move_uploaded_file($_FILES['GovIDPath']['tmp_name'], $govIDPath);
        }

        if ($_FILES['TrainingMaterialsPath']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['TrainingMaterialsPath']['name'], PATHINFO_EXTENSION);
            $fileName = "{$timestamp}_{$safeFullName}_TrainingMaterial.{$ext}";
            $trainingPath = $uploadDir . $fileName;
            move_uploaded_file($_FILES['TrainingMaterialsPath']['tmp_name'], $trainingPath);
        }

        $veterinarian = [
            'ClinicName' => $_POST['ClinicName'],
            'ClinicAddress' => $_POST['ClinicAddress'],
            'LocationEnabled' => $_POST['LocationEnabled'] === '1' ? 1 : 0,
            'License' => $_POST['License'],
            'Speciality' => $_POST['Speciality'],
            'Services' => $_POST['Services'],
            'WorkingHours' => $_POST['WorkingHours'],
            'VetLicensePath' => $vetLicensePath,
            'GovIDPath' => $govIDPath,
            'HostTraining' => $_POST['HostTraining'] ?? 'No',
            'TrainingMaterialsPath' => $trainingPath
        ];
    }


    if ($role === 'Benefactor') {
        $benefactor = [
            'OrganizationType' => $_POST['otype'] ?? 'IndividualDonor',
            'DonationType' => $_POST['donationtype'],
            'PreferredCampaign' => $_POST['campaign'],
            'Availability' => $_POST['availability'],
            'PaymentMethod' => $_POST['payment-method'],
            'SavePayment' => isset($_POST['save-payment']) ? 'Yes' : 'No',
            'SponsorEvents' => isset($_POST['sponsor-events']) ? 'Yes' : 'No',
            'NgoPartnership' => isset($_POST['ngo-partnership']) ? 'Yes' : 'No',
            'AdditionalNotes' => $_POST['notes'] ?? ''
        ];
    }

    // Final User Data Array
    $userData = [
        'FullName' => $fullName,
        'Email' => $email,
        'Phone' => $phone,
        'Password' => $password,
        'HomeAddress' => $address,
        'CityStateCountry' => $cityStateCountry,
        'Role' => $role,
        'ProfilePicturePath' => $profilePicturePath,
        'SocialMediaLinks' => $socialMediaLinks,
        'EmailVerified' => $emailVerified,
        'Preferences' => $preferences,
        'Volunteer' => $volunteer,
        'Veterinarian' => $veterinarian,
        'Benefactor' => $benefactor
    ];

    // Register Using Model
    $result = $model->registerUser($userData);
    
    if ($result === true) {
        // Fetch the user just registered (email is unique)
        $user = $model->findUserByEmail($email, $_POST['Password']);

        if ($user) {
            // Start session values
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['user_full_name'] = $user['FullName'];
            $_SESSION['user_role'] = $user['Role'];
            $_SESSION['registration_success'] = true;

            // Redirect based on role
            switch ($role) {
                case 'Volunteer':
                    header("Location: /PawsitiveWellbeing/Volunteer/view/VolunteerHomepage.php");
                    break;
                case 'Veterinarian':
                    header("Location: /PawsitiveWellbeing/Veterinarian/view/VeterinarianHomepage.php");
                    break;
                case 'Benefactor':
                    header("Location: /PawsitiveWellbeing/Benefactor/view/Homepage.php");
                    break;
                default:
                    header("Location: /PawsitiveWellbeing/General User/view/GeneralUserHomepage.php");
            }
            exit();
        } else {
            echo "Registration successful but user session could not be initialized.";
        }
    }

    if ($result === true) {
        $_SESSION['registration_success'] = true;
        switch ($role) {
            case 'Volunteer':
                header("Location: /PawsitiveWellbeing/Volunteer/view/VolunteerHomepage.php");
                break;
            case 'Veterinarian':
                header("Location: /PawsitiveWellbeing/Veterinarian/view/VeterinarianHomepage.php");
                break;
            case 'Benefactor':
                header("Location: /PawsitiveWellbeing/Benefactor/view/Homepage.php");
                break;
            default:
                header("Location: /PawsitiveWellbeing/General User/view/GeneralUserHomepage.php");
        }
        exit();
    } else {
        echo "Registration Failed: " . $result;
    }

} else {
    echo "Invalid Request Method";
}
?>
