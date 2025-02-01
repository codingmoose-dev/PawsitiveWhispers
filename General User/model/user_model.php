<?php
class UserModel {
    private $conn;

    public function __construct($servername = "localhost", $username = "root", $password = "", $dbname = "PawsitiveWellbeing") {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function registerUser($fullName, $email, $phone, $password, $address, $cityStateCountry, $locationEnabled, $adoptionNotifications, $donationCampaigns, $newsletterSubscription, $profilePicturePath, $socialMediaLink, $emailVerified) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $this->conn->prepare("INSERT INTO GeneralUsers (FullName, Email, Phone, Password, Address, CityStateCountry, LocationEnabled, AdoptionNotifications, DonationCampaignNotifications, NewsletterSubscription, ProfilePicturePath, SocialMediaLinks, EmailVerified) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("sssssssssssss", $fullName, $email, $phone, $hashedPassword, $address, $cityStateCountry, $locationEnabled, $adoptionNotifications, $donationCampaigns, $newsletterSubscription, $profilePicturePath, $socialMediaLink, $emailVerified);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM GeneralUsers WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    
    public function __destruct() {
        $this->conn->close();
    }
}
?>
