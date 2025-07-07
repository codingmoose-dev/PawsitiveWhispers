<?php
class VolunteerModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "PawsitiveWellbeing");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function registerVolunteer($data) {
        $this->conn->begin_transaction();

        try {
            $hashedPassword = password_hash($data['Password'], PASSWORD_DEFAULT);

            $stmtUser = $this->conn->prepare("
                INSERT INTO Users 
                    (FullName, Email, Phone, Password, HomeAddress, CityStateCountry, Role, ProfilePicturePath, SocialMediaLinks, EmailVerified)
                VALUES (?, ?, ?, ?, ?, ?, 'Volunteer', ?, ?, 0)
            ");

            $profilePicturePath = $data['ProfilePicturePath'] ?? null;
            $socialMediaLinks = $data['SocialMediaLinks'] ?? null;

            $stmtUser->bind_param(
                "ssssssss",
                $data['FullName'],
                $data['Email'],
                $data['Phone'],
                $hashedPassword,
                $data['HomeAddress'],
                $data['CityStateCountry'],
                $profilePicturePath,
                $socialMediaLinks
            );

            $stmtUser->execute();
            $userId = $this->conn->insert_id;
            $stmtUser->close();

            $stmtVol = $this->conn->prepare("
                INSERT INTO VolunteerDetails
                (UserID, LocationEnabled, EmergencyRescue, OrganizeCampaigns, ManageAdoption, Skills, ExperienceYears, Availability)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");

            // Cast booleans to int 0/1
            $locationEnabled = isset($data['LocationEnabled']) ? (int)$data['LocationEnabled'] : 0;
            $emergencyRescue = isset($data['EmergencyRescue']) ? (int)$data['EmergencyRescue'] : 0;
            $organizeCampaigns = isset($data['OrganizeCampaigns']) ? (int)$data['OrganizeCampaigns'] : 0;
            $manageAdoption = isset($data['ManageAdoption']) ? (int)$data['ManageAdoption'] : 0;
            $experienceYears = max(0, (int)($data['ExperienceYears'] ?? 0));
            $availability = $data['Availability'] ?? 'Anytime';
            $skills = $data['Skills'] ?: 'Not provided';

            $stmtVol->bind_param(
                "iiiissis",
                $userId,
                $locationEnabled,
                $emergencyRescue,
                $organizeCampaigns,
                $manageAdoption,
                $skills,
                $experienceYears,
                $availability
            );

            $stmtVol->execute();
            $stmtVol->close();

            // Insert default GeneralUserPreferences entry
            $stmtPrefs = $this->conn->prepare("INSERT INTO GeneralUserPreferences (UserID) VALUES (?)");
            $stmtPrefs->bind_param("i", $userId);
            $stmtPrefs->execute();
            $stmtPrefs->close();

            $this->conn->commit();
            return $userId;
        } catch (Exception $e) {
            $this->conn->rollback();
            return "Error: " . $e->getMessage();
        }
    }

    public function getOngoingRescueMissions() {
        $query = "SELECT * FROM RescueMissions WHERE Status IN ('In Progress', 'Pending')";
        $result = $this->conn->query($query);

        $missions = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $missions[] = $row;
            }
        }
        return $missions;
    }

    public function getAllVolunteers() {
        $query = "
            SELECT u.UserID, u.FullName, u.Email, u.Phone, u.ProfilePicturePath, 
                   v.LocationEnabled, v.EmergencyRescue, v.OrganizeCampaigns, v.ManageAdoption, v.Skills, v.ExperienceYears, v.Availability
            FROM Users u
            INNER JOIN VolunteerDetails v ON u.UserID = v.UserID
            WHERE u.Role = 'Volunteer'
        ";

        $result = $this->conn->query($query);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function getVolunteerByID($userId) {
        $stmt = $this->conn->prepare("
            SELECT u.UserID, u.FullName, u.Email, u.Phone, u.ProfilePicturePath,
                   v.LocationEnabled, v.EmergencyRescue, v.OrganizeCampaigns, v.ManageAdoption, v.Skills, v.ExperienceYears, v.Availability
            FROM Users u
            INNER JOIN VolunteerDetails v ON u.UserID = v.UserID
            WHERE u.UserID = ? AND u.Role = 'Volunteer'
            LIMIT 1
        ");

        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>