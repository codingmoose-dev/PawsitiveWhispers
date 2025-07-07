<?php
class UserModel {
    private $conn;

    public function __construct($servername = "localhost", $username = "root", $password = "", $dbname = "PawsitiveWellbeing") {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function registerUser(
        $fullName, 
        $email, 
        $phone, 
        $password, 
        $address, 
        $cityStateCountry,
        $locationEnabled = 0,
        $adoptionNotifications = 0,
        $donationCampaignNotifications = 0,
        $newsletterSubscription = 0,
        $profilePicturePath = null,
        $socialMediaLink = null,
        $emailVerified = 0,
        $role = 'General'
    ) {
        $this->conn->begin_transaction();

        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmtUser = $this->conn->prepare("
                INSERT INTO Users 
                    (FullName, Email, Phone, Password, HomeAddress, CityStateCountry, Role, ProfilePicturePath, SocialMediaLinks, EmailVerified)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmtUser->bind_param(
                "sssssssssi",
                $fullName,
                $email,
                $phone,
                $hashedPassword,
                $address,
                $cityStateCountry,
                $role,
                $profilePicturePath,
                $socialMediaLink,
                $emailVerified
            );
            $stmtUser->execute();

            $userId = $this->conn->insert_id;
            $stmtUser->close();

            $stmtPrefs = $this->conn->prepare("
                INSERT INTO GeneralUserPreferences
                    (UserID, LocationEnabled, AdoptionNotifications, DonationCampaignNotifications, NewsletterSubscription)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmtPrefs->bind_param(
                "iiiii",
                $userId,
                $locationEnabled,
                $adoptionNotifications,
                $donationCampaignNotifications,
                $newsletterSubscription
            );
            $stmtPrefs->execute();
            $stmtPrefs->close();

            // Commit transaction
            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            $this->conn->rollback();
            return "Error: " . $e->getMessage();
        }
    }

    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("
            SELECT u.*, g.LocationEnabled, g.AdoptionNotifications, g.DonationCampaignNotifications, g.NewsletterSubscription
            FROM Users u
            LEFT JOIN GeneralUserPreferences g ON u.UserID = g.UserID
            WHERE u.Email = ?
            LIMIT 1
        ");
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
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>