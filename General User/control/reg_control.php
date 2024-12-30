<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $errors = [];

    /*
    if (empty($_POST["FullName"])) {
        $errors[] = "Full Name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST["FullName"])) {
        $errors[] = "Full Name should contain only alphabets.";
    }
        */

    
    if (empty($_POST["Email"])) {
        $errors[] = "Email is required.";
    } elseif (!preg_match("/@.*\.xyz$/", $_POST["Email"])) {
        $errors[] = "Email must be valid and end with '.xyz' domain.";
    }

    
    if (empty($_POST["Password"])) {
        $errors[] = "Password is required.";
    } elseif (!preg_match("/[0-9]/", $_POST["Password"])) {
        $errors[] = "Password must contain at least one numeric character.";
    }

    
    if (empty($_POST["ConfirmPassword"])) {
        $errors[] = "Confirm Password is required.";
    } elseif ($_POST["Password"] !== $_POST["ConfirmPassword"]) {
        $errors[] = "Confirm Password must match Password.";
    }

    
    if (empty($_POST["Phone"])) {
        $errors[] = "Phone number is required.";
    } elseif (!is_numeric($_POST["Phone"])) {
        $errors[] = "Phone number must be numeric.";
    }

    
    if (empty($errors)) {
        
        $userData = [
            "FullName" => $_POST["FullName"],
            "Email" => $_POST["Email"],
            "Phone" => $_POST["Phone"],
            "Password" => password_hash($_POST["Password"], PASSWORD_DEFAULT), 
            "Address" => $_POST["Address"] ?? null,
            "CityStateCountry" => $_POST["CityStateCountry"] ?? null,
            "Location" => $_POST["Location"] ?? null,
            "AdoptionNotifications" => $_POST["AdoptionNotifications"] ?? null,
            "DonationCampaigns" => $_POST["DonationCampaigns"] ?? null,
            "ProfilePicture" => $_FILES["ProfilePicture"]["name"] ?? null,
            "SocialMediaLinks" => $_POST["SocialMediaLinks"] ?? null,
            "NewsletterSubscription" => $_POST["NewsletterSubscription"] ?? null,
            "EmailVerification" => isset($_POST["EmailVerification"]) ? true : false
        ];

       
        $dataFolder = '../data';
   
   
        if (!file_exists($dataFolder)) {
            mkdir($dataFolder, 0777, true);
        }
   
   
        $jsonFile = $dataFolder . '/userdata.json';
        $currentData = [];
   
       
        if (file_exists($jsonFile)) {
            $currentData = json_decode(file_get_contents($jsonFile), true);
        }
   
       
        $currentData[] = $userData;
   
       
        file_put_contents($jsonFile, json_encode($currentData, JSON_PRETTY_PRINT));
   
        echo "Form submitted successfully!";
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
    ?>
   
    

?>