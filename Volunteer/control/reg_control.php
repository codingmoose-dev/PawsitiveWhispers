<?php
$errors = [];


if (empty($_POST['name'])) {
    $errors[] = "Full Name is required.";
}
if (empty($_POST['email'])) {
    $errors[] = "Email is required.";
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

if (empty($_POST['phone'])) {
    $errors[] = "Phone number is required.";
} elseif (!preg_match('/^\d{3}[-.\s]?\d{3}[-.\s]?\d{4}$/', $_POST['phone'])) {
    $errors[] = "Phone number format should be 123-456-7890, 123.456.7890, or 123 456 7890.";
}

if (empty($_POST['password']) || empty($_POST['confirm_password'])) {
    $errors[] = "Password and Confirm Password are required.";
} elseif ($_POST['password'] !== $_POST['confirm_password']) {
    $errors[] = "Passwords do not match.";
}

if (empty($_POST['location'])) {
    $errors[] = "Please specify if you want to enable location services.";
}

if (empty($_POST['volunteer_type'])) {
    $errors[] = "Please select at least one Volunteer Type.";
}

if (!isset($_POST['experience_level']) || $_POST['experience_level'] === "") {
    $errors[] = "Experience Level is required.";
}

if (!empty($_POST['emergency_contact']) && !preg_match('/^\+\d{3}-\d{8,10}$/', $_POST['emergency_contact'])) {
    $errors[] = "Emergency contact format should be +123-12345678.";
}

if (!empty($_FILES['id_upload']['name'])) {
    $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
    if (!in_array($_FILES['id_upload']['type'], $allowed_types)) {
        $errors[] = "ID upload must be a JPEG, PNG, or PDF file.";
    }
    if ($_FILES['id_upload']['size'] > 2 * 1024 * 1024) {
        $errors[] = "ID upload must be less than 2 MB.";
    }
}


if (empty($errors)) {
    
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'home_address' => $_POST['home_address'] ?? '',
        'city_state_country' => $_POST['city_state_country'] ?? '',
        'location_services' => $_POST['location'] ?? '',
        'volunteer_type' => $_POST['volunteer_type'] ?? [],
        'experience_level' => $_POST['experience_level'],
        'skills' => $_POST['skills'] ?? '',
        'emergency_contact' => $_POST['emergency_contact'] ?? '',
        'training_opt_in' => isset($_POST['training_opt_in']) ? 'Yes' : 'No',
        'preferences' => [
            'emergency_missions' => $_POST['emergency_missions'] ?? '',
            'organize_campaigns' => $_POST['organize_campaigns'] ?? '',
            'adoption_approval' => $_POST['adoption_approval'] ?? ''
        ]
    ];

    
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);

    
    $dataFolder = '../data'; 
    if (!file_exists($dataFolder)) {
        mkdir($dataFolder, 0777, true); 
    }


    file_put_contents($dataFolder . '/userdata.json', $jsonData);

    
    echo "<h3>Form submitted successfully!</h3>";
    echo "<p>User data has been saved to <code>userdata.json</code>.</p>";
} else {
    
    echo "<h3>Please correct the following errors:</h3>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
}


    ?>
   
