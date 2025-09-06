<?php

class BenefactorModel {

    private $conn;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "PawsitiveWhispers"; 
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function recordDonation($donorID, $amount, $campaignID, $animalID, $purpose) {
        $this->conn->begin_transaction();
        try {
            // Update the SQL query to include the Purpose column
            $sql = "INSERT INTO Donations (DonorID, CampaignID, AnimalID, DonationAmount, Purpose) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            // Add "s" for string type for the new purpose field
            $stmt->bind_param("iiids", $donorID, $campaignID, $animalID, $amount, $purpose);
            
            if (!$stmt->execute()) {
                throw new Exception("Failed to record donation.");
            }
            $stmt->close();

            // Step 2: If it's a campaign donation, update the campaign's raised amount
            if ($campaignID !== null) {
                $updateSql = "UPDATE Campaigns SET RaisedAmount = RaisedAmount + ? WHERE CampaignID = ?";
                $updateStmt = $this->conn->prepare($updateSql);
                $updateStmt->bind_param("di", $amount, $campaignID);
                
                if (!$updateStmt->execute()) {
                    throw new Exception("Failed to update campaign amount.");
                }
                $updateStmt->close();
            }

            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            $this->conn->rollback();
            return false;
        }
    }      

    public function getTotalDonationsByUser($userID) {
        $sql = "SELECT SUM(DonationAmount) AS TotalDonated FROM Donations WHERE DonorID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        return $row['TotalDonated'] ?? 0.00;
    }
    
    public function getOngoingCampaigns() {
        $query = "
            SELECT 
                c.CampaignID, c.CampaignName, c.Description, c.StartDate, c.EndDate, 
                c.GoalAmount, c.RaisedAmount, u.FullName AS CreatorName
            FROM 
                Campaigns c
            LEFT JOIN 
                Users u ON c.CreatedBy = u.UserID
            WHERE 
                c.EndDate >= CURDATE() OR c.EndDate IS NULL
        ";
        
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getSupportableAnimals() {
        $sql = "
            SELECT
                a.AnimalID,
                a.Name,
                a.Species,
                a.Breed,
                a.Age,
                a.PicturePath,
                a.AnimalCondition,
                -- Subquery to get the most recent diagnosis for each animal
                (SELECT mr.Diagnosis 
                FROM MedicalRecords mr 
                WHERE mr.AnimalID = a.AnimalID 
                ORDER BY mr.TreatmentDate DESC 
                LIMIT 1) AS LatestDiagnosis
            FROM 
                Animals a
            WHERE 
                a.AdoptionStatus IN ('Available', 'UnderCare', 'Pending')
        ";
        
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getAllBenefactors() {
        $query = "
            SELECT 
                u.UserID, u.FullName, u.Email, u.Phone, u.HomeAddress, u.CityStateCountry,
                b.OrganizationType, b.DonationType, b.PreferredCampaign, b.PaymentMethod
            FROM Users u
            INNER JOIN BenefactorDetails b ON u.UserID = b.UserID
            WHERE u.Role = 'Benefactor'
        ";

        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function getDonationsByBenefactor($userID) {
        $sql = "SELECT d.DonationAmount, d.DonationDate, c.CampaignName, a.Name AS AnimalName 
                FROM Donations d
                LEFT JOIN Campaigns c ON d.CampaignID = c.CampaignID
                LEFT JOIN Animals a ON d.AnimalID = a.AnimalID
                WHERE d.DonorID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $donations = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $donations;
    }

    public function closeConnection() {
        if (isset($this->conn)) {
            $this->conn->close();
        }
    }
}