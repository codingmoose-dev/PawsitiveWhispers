<!DOCTYPE html>
<html>
<head>
    <title>Registration Confirmation</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];
    $address = $_POST['address'];
    $otype = $_POST['otype'];
    $donationtype = $_POST['donationtype'];
    $campaign = $_POST['campaign'];
    $paymentMethod = $_POST['payment-method'];
    $savePayment = $_POST['save-payment'];
    $sponsorEvents = isset($_POST['sponsor-events']) ? $_POST['sponsor-events'] : null;
    $ngoPartnership = isset($_POST['ngo-partnership']) ? $_POST['ngo-partnership'] : null;
    $captcha = $_POST['captcha'];
    $terms = isset($_POST['terms-conditions']);
    $emailVerified = isset($_POST['email-verification']);

    // Validation flags and messages
    $errors = [];

    // Name validation: No numbers allowed
    if (empty($fname) || !preg_match("/^[a-zA-Z ]*$/", $fname)) {
        $errors[] = "Full Name should not contain any numbers and must not be empty.";
    }

    // Password validation: Required and must contain at least one special character
    if (empty($pwd) || !preg_match("/[@#$&]/", $pwd)) {
        $errors[] = "Password must contain at least one special character (@, #, $, &).";
    }

    // Password match validation
    if ($pwd !== $cpwd) {
        $errors[] = "Passwords do not match.";
    }

    // Phone validation: Must not exceed 11 digits
    if (empty($phone) || !preg_match("/^\d{1,11}$/", $phone)) {
        $errors[] = "Phone number must not exceed 11 digits.";
    }

    // Date validation (assuming you want to validate a 'date' field in your form)
    if (isset($_POST['date']) && !empty($_POST['date'])) {
        $date = $_POST['date'];
        $d = DateTime::createFromFormat('Y-m-d', $date);
        if (!$d || $d->format('Y-m-d') !== $date) {
            $errors[] = "Please enter a valid date (YYYY-MM-DD).";
        }
    }

    // Terms and Conditions
    if (!$terms) {
        $errors[] = "You must agree to the Terms & Conditions.";
    }

    // Display Errors or Success Message
    if (!empty($errors)) {
        echo "<h1>Registration Failed</h1>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<h1>Registration Successful</h1>";
        echo "<p>Thank you for registering as an Animal Care Benefactor, " . htmlspecialchars($fname) . ".</p>";
        echo "<p>We have sent a confirmation email to: " . htmlspecialchars($email) . "</p>";

        // Prepare data array for JSON
        $userData = [
            "fname" => $fname,
            "email" => $email,
            "phone" => $phone,
            "address" => $address,
            "otype" => $otype,
            "donationtype" => $donationtype,
            "campaign" => $campaign,
            "paymentMethod" => $paymentMethod,
            "savePayment" => $savePayment,
            "sponsorEvents" => $sponsorEvents,
            "ngoPartnership" => $ngoPartnership,
            "captcha" => $captcha
        ];

        // JSON encode the data
        $jsonData = json_encode($userData, JSON_PRETTY_PRINT);

        // Write JSON data to a file
        $file = 'userdata.json';
        if (file_put_contents($file, $jsonData)) {
            echo "<p>Data successfully saved to <strong>$file</strong>.</p>";
        } else {
            echo "<p>Error saving data to file.</p>";
        }
    }
}
?>

</body>
</html>