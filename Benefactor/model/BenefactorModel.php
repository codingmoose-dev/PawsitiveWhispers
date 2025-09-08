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
            $sql = "INSERT INTO Donations (DonorID, CampaignID, AnimalID, DonationAmount, Purpose) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iiids", $donorID, $campaignID, $animalID, $amount, $purpose);
            
            if (!$stmt->execute()) {
                throw new Exception("Failed to record donation.");
            }
            $stmt->close();
            
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
        $sql = "SELECT 
            d.DonationAmount, d.DonationDate, d.Purpose, c.CampaignName, 
            a.AnimalID, a.Name AS AnimalName, a.Species AS AnimalSpecies, 
            a.Breed AS AnimalBreed, a.Age AS AnimalAge, a.AnimalCondition, 
            a.PicturePath, a.AdoptionStatus
        FROM Donations d
        LEFT JOIN Campaigns c ON d.CampaignID = c.CampaignID
        LEFT JOIN Animals a ON d.AnimalID = a.AnimalID
        WHERE d.DonorID = ?
        ORDER BY d.DonationDate DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $donations = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $donations;
    }

    public function getFinancialSummary() {
    $summary = [];

    // Total Donations Received
    $stmt1 = $this->conn->prepare("SELECT SUM(DonationAmount) AS TotalReceived FROM Donations");
    $stmt1->execute();
    $result1 = $stmt1->get_result()->fetch_assoc();
    $summary['total_received'] = $result1['TotalReceived'] ?? 0;
    $stmt1->close();

    // Total Funds Used
    $stmt2 = $this->conn->prepare("SELECT SUM(AmountUsed) AS TotalUsed FROM FundUsage");
    $stmt2->execute();
    $result2 = $stmt2->get_result()->fetch_assoc();
    $summary['total_used'] = $result2['TotalUsed'] ?? 0;
    $stmt2->close();
    
    // Number of animals helped (unique animals with donations)
    $stmt3 = $this->conn->prepare("SELECT COUNT(DISTINCT AnimalID) AS AnimalsHelped FROM Donations WHERE AnimalID IS NOT NULL");
    $stmt3->execute();
    $result3 = $stmt3->get_result()->fetch_assoc();
    $summary['animals_helped'] = $result3['AnimalsHelped'] ?? 0;
    $stmt3->close();

    return $summary;
    }

    // Gets a detailed log of all funds used, joining with the user who spent it.
    public function getFundUsageLog() {
        $query = "
            SELECT 
                fu.DateUsed, 
                fu.AmountUsed, 
                fu.Purpose, 
                u.FullName AS VolunteerName
            FROM 
                FundUsage fu
            LEFT JOIN 
                Users u ON fu.UsedBy = u.UserID
            ORDER BY 
                fu.DateUsed DESC
        ";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Gets the financial status of all campaigns.
    public function getCampaignFinancials() {
        $query = "SELECT CampaignName, GoalAmount, RaisedAmount FROM Campaigns ORDER BY StartDate DESC";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function closeConnection() {
        if (isset($this->conn)) {
            $this->conn->close();
        }
    }
}