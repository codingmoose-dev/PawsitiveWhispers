<?php
session_start();
$error =[];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    
    if (empty($_POST["username"])) {
        $errors[] = "Full Name is .";
    } elseif (strlen($_POST["username"]) > 50) {
        $errors[] = "Full Name must be less than 50 characters.";
    }

    
    if (empty($_POST["phone"])) {
        $errors[] = "Phone number is .";
    } elseif (!preg_match("/^0[0-9]{9}$/", $_POST["phone"])) {
        $errors[] = "Phone number must start with 0 and be 10 digits long.";
    }

    
    if (empty($_POST["password"])) {
        $errors[] = "Password is .";
    } elseif (strlen($_POST["password"]) < 6 || !preg_match("/[a-z]/", $_POST["password"])) {
        $errors[] = "Password must be at least 6 characters long and contain at least one lowercase letter.";
    }

    
    if (empty($errors)) {
        $userData = [
            "username" => $_POST["username"],
            "email" => $_POST["email"] ?? '',
            "phone" => $_POST["phone"],
            "password" => password_hash($_POST["password"], PASSWORD_DEFAULT), // Store hashed password
            "medical_license_number" => $_POST["lisence"] ?? '',
            "clinic_name" => $_POST["clinicname"] ?? '',
            "speciality" => $_POST["speciality"] ?? '',
            "services" => $_POST["services"] ?? '',
            "working_hours" => $_POST["working_hours"] ?? '',
            "vet_license" => $_FILES["vet_license"]["name"] ?? '',
            "gov_id" => $_FILES["gov_id"]["name"] ?? '',
            "training_materials" => $_FILES["training_materials"]["name"] ?? '',
            "host_training" => $_POST["host_training"] ?? ''
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
//set session
$SESSION['UNAME']=$username;
header('location: ../reg/vet_control.php');
exit();

    ?>
    