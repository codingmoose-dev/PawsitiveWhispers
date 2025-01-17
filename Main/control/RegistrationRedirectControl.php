<?php
// C:\xampp\htdocs\PawsitiveWellbeing\Main\control\RegistrationRedirect.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected category
    $category = $_POST['category'] ?? '';

    // Define the base directory
    $baseDir = '/PawsitiveWellbeing';

    // Redirect based on the category
    switch ($category) {
        case 'GeneralUser':
            header("Location: {$baseDir}/GeneralUser/view/GeneralUserRegistration.php");
            break;
        case 'Volunteer':
            header("Location: {$baseDir}/Volunteer/view/VolunteerRegistration.php");
            break;
        case 'Benefactor':
            header("Location: {$baseDir}/Benefactor/view/BenefactorRegistration.php");
            break;
        case 'Veterinarian':
            header("Location: {$baseDir}/Veterinarian/view/VeterinarianRegistration.php");
            break;
        default:
            // Redirect to an error page or the home page if the category is invalid
            header("Location: {$baseDir}/Main/view/Error.php");
            break;
    }
    exit();
} else {
    // Redirect to the home page if the request method is not POST
    header('Location: /PawsitiveWellbeing/index.php');
    exit();
}