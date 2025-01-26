<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected category
    $category = $_POST['category'] ?? '';

    // Redirect based on the category
    switch ($category) {
        case 'GeneralUser':
            header("Location: /PawsitiveWellbeing/GeneralUser/view/GeneralUserRegistration.php");
            break;
        case 'Volunteer':
            header("Location: /PawsitiveWellbeing/Volunteer/view/VolunteerRegistration.php");
            break;
        case 'Benefactor':
            header("Location: /PawsitiveWellbeing/Benefactor/view/BenefactorRegistration.php");
            break;
        case 'Veterinarian':
            header("Location: /PawsitiveWellbeing/Veterinarian/view/VeterinarianRegistration.php");
            break;
        default:
            // Redirect to an error page or the home page if the category is invalid
            header("Location: /PawsitiveWellbeing/Main/view/Error.php");
            break;
    }
    exit();
} else {
    // Redirect to the home page if the request method is not POST
    header("Location: /PawsitiveWellbeing/index.php");
    exit();
}
