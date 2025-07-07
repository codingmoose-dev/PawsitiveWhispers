<?php

class BenefactorModel {

    private $conn;

    public function __construct() {
        $this->conn = $this->openConn();
    }

    private function openConn() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "PawsitiveWellbeing"; 
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    // Get all benefactors from the database
    public function getAllBenefactors() {
        $query = "
            SELECT 
                u.UserID, u.FullName, u.Email, u.Phone, u.HomeAddress, u.CityStateCountry,
                b.OrganizationType, b.DonationType, b.PreferredCampaign, b.PaymentMethod,
                b.SavePayment, b.SponsorEvents, b.NgoPartnership, b.AdditionalNotes,
                g.LocationEnabled, g.AdoptionNotifications, g.DonationCampaignNotifications, g.NewsletterSubscription
            FROM Users u
            INNER JOIN BenefactorDetails b ON u.UserID = b.UserID
            INNER JOIN GeneralUserPreferences g ON u.UserID = g.UserID
            WHERE u.Role = 'Benefactor'
        ";

        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Error preparing statement: " . $this->conn->error);
        }

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // Delete a benefactor user
    public function deleteUser($userID) {
        $stmt = $this->conn->prepare("DELETE FROM Users WHERE UserID = ? AND Role = 'Benefactor'");
        $stmt->bind_param("i", $userID);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    // Get all campaigns
    public function getOngoingCampaigns() {
        $query = "SELECT * FROM Campaigns";
        $result = $this->conn->query($query);
        $campaigns = [];

        while ($row = $result->fetch_assoc()) {
            $campaigns[] = $row;
        }

        return $campaigns;
    }

    // Get donations by benefactor's UserID
    public function getDonationsByBenefactor($userID) {
        $sql = "
            SELECT 
                d.DonationAmount, d.DonationDate, 
                c.CampaignName, 
                a.Name AS AnimalName, a.Species AS AnimalSpecies, 
                a.Breed AS AnimalBreed, a.Age AS AnimalAge, 
                a.AnimalCondition, a.PicturePath
            FROM Donations d
            LEFT JOIN Campaigns c ON d.CampaignID = c.CampaignID
            LEFT JOIN Animals a ON d.AnimalID = a.AnimalID
            WHERE d.DonorID = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        $donations = [];
        while ($row = $result->fetch_assoc()) {
            $donations[] = $row;
        }

        $stmt->close();
        return $donations;
    }

    // Get animals currently under care or available
    public function getAnimalsUnderCare() {
        $sql = "
            SELECT 
                AnimalID, Name, Species, Breed, Age, Gender, 
                AnimalCondition, RescueDate, 
                AdoptionStatus, ShelterID, PicturePath
            FROM Animals
            WHERE AdoptionStatus IN ('Available', 'UnderCare')
        ";
        $result = $this->conn->query($sql);
        $animals = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $animals[] = $row;
            }
        }

        return $animals;
    }

    // Get current raised amount for a campaign
    public function getCurrentRaisedAmount($campaignId) {
        $query = "SELECT RaisedAmount FROM Campaigns WHERE CampaignID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $campaignId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['RaisedAmount'];
        }

        return null;
    }

    // Update raised amount for a campaign
    public function updateRaisedAmount($campaignId, $newRaisedAmount) {
        $query = "UPDATE Campaigns SET RaisedAmount = ? WHERE CampaignID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("di", $newRaisedAmount, $campaignId);
        return $stmt->execute();
    }

    // Close DB connection
    public function closeConnection() {
        if (isset($this->conn)) {
            $this->conn->close();
        }
    }
}
?>
