<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pawsitivewellbeing";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to register a new user
function registerUser($fullName, $email, $phone, $password, $address, $cityStateCountry, $location, $adoptionNotifications, $donationCampaigns, $profilePicture, $socialMediaLinks, $newsletterSubscription, $emailVerification) {
    global $conn;

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL query to insert the user data into the database
    $sql = "INSERT INTO users (FullName, Email, Phone, Password, Address, CityStateCountry, Location, AdoptionNotifications, DonationCampaigns, ProfilePicture, SocialMediaLinks, NewsletterSubscription, EmailVerification)
            VALUES ('$fullName', '$email', '$phone', '$hashedPassword', '$address', '$cityStateCountry', '$location', '$adoptionNotifications', '$donationCampaigns', '$profilePicture', '$socialMediaLinks', '$newsletterSubscription', '$emailVerification')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Function to authenticate a user during login
function loginUser($email, $password) {
    global $conn;
    
    // Query to get the user by email
    $sql = "SELECT * FROM users WHERE Email = '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $row['Password'])) {
            return $row; // Return user data if login is successful
        }
    }
    return false; // Return false if login fails
}

// Uncomment this line to close the connection when done (optional but not necessary here)
// $conn->close(); 
?>
