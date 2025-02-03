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
    

    // Function to register a benefactor
    public function registerBenefactor($fullName, $email, $phone, $password, $address, $organizationType, $donationType, $preferredCampaign, $availability, $paymentMethod, $savePayment, $sponsorEvents, $ngoPartnership, $additionalNotes) {
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO Benefactors (FullName, Email, Phone, Password, Address, OrganizationType, DonationType, PreferredCampaign, Availability, PaymentMethod, SavePayment, SponsorEvents, NgoPartnership, AdditionalNotes) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssssss", $fullName, $email, $phone, $password, $address, $organizationType, $donationType, $preferredCampaign, $availability, $paymentMethod, $savePayment, $sponsorEvents, $ngoPartnership, $additionalNotes);
        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }

    // Function to check if the email already exists
    public function isEmailExists($email) {
        $stmt = $this->conn->prepare("SELECT Email FROM Benefactors WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0; // Return true if email exists, false otherwise
    }


    // Get all benefactors from the database
    public function getAllBenefactors() {
        $query = "SELECT 
                    BenefactorID, FullName, Email, Phone, Password, Address, OrganizationType, 
                    DonationType, PreferredCampaign, PaymentMethod, 
                    SavePayment, SponsorEvents, NgoPartnership, AdditionalNotes
                  FROM Benefactors"; 
        $stmt = $this->conn->prepare($query);
        
        if ($stmt === false) {
            die("Error preparing statement: " . $this->conn->error);
        }

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
        } else {
            return []; // Return empty array if query fails
        }
    }


    // Function to delete a user based on BenefactorID
    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM Benefactors WHERE BenefactorID = ?");
        $stmt->bind_param("i", $id); 
        $stmt->execute();

        // Return true if any row was affected, otherwise false
        return $stmt->affected_rows > 0;
    }

    public function getOngoingCampaigns() {
        $query = "SELECT * FROM Campaigns";
        $result = $this->conn->query($query);
        $campaigns = [];
    
        while ($row = $result->fetch_assoc()) {
            $campaigns[] = $row;
        }       
        return $campaigns;
    }   

    // Method to get donations by BenefactorID
    public function getDonationsByBenefactor($benefactorID) {
        $sql = "SELECT Donations.DonationAmount, Donations.DonationDate, 
                    Campaigns.CampaignName, Animal.Name AS AnimalName, Animal.Species AS AnimalSpecies, 
                    Animal.Breed AS AnimalBreed, Animal.Age AS AnimalAge, Animal.AnimalCondition, 
                    Animal.PicturePath 
                    FROM Donations 
                    JOIN Campaigns ON Donations.CampaignID = Campaigns.CampaignID
                    JOIN Animal ON Campaigns.CampaignID = Animal.ShelterID
                    WHERE Donations.BenefactorID = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $benefactorID);
        $stmt->execute();
        $result = $stmt->get_result();

        $donations = [];
        while ($row = $result->fetch_assoc()) {
            $donations[] = $row;
        }

        $stmt->close();
        return $donations;
    }

    public function getAnimalsUnderCare() {
        $sql = "SELECT Name, Species, Breed, Age, Gender, AnimalCondition, PicturePath, RescueDate, AdoptionStatus, ShelterID FROM Animal WHERE AdoptionStatus IN ('Available', 'UnderCare')";
        $result = $this->conn->query($sql);
        $animals = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $animals[] = $row;
            }
        }
        return $animals;

    }


    public function getCurrentRaisedAmount($campaignId) {
        // Query to get the current raised amount for the given campaign ID
        $query = "SELECT RaisedAmount FROM Campaigns WHERE CampaignID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $campaignId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['RaisedAmount'];  // Return the current raised amount
        }

        return null;  // Return null if campaign not found
    }

    public function updateRaisedAmount($campaignId, $newRaisedAmount) {
        // Query to update the raised amount in the database
        $query = "UPDATE Campaigns SET RaisedAmount = ? WHERE CampaignID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("di", $newRaisedAmount, $campaignId);

        return $stmt->execute();  // Return true if update is successful, false otherwise
    }

    public function closeConnection() {
        if (isset($this->conn)) {
            $this->conn->close();
        }
    }
}
?>
