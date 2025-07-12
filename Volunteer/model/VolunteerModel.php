<?php
class VolunteerModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "PawsitiveWellbeing");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Get rescue missions with names of reporter and assigned volunteer
    public function getOngoingRescueMissions() {
        $query = "
            SELECT 
                rm.MissionID,
                rm.MissionName,
                rm.Description,
                ru.FullName AS ReporterName,
                vu.FullName AS AssignedVolunteerName,
                vu.UserID AS AssignedVolunteerID,
                rm.Location,
                rm.Status,
                rm.PriorityLevel
            FROM RescueMissions rm
            JOIN Users ru ON rm.ReportedBy = ru.UserID
            LEFT JOIN Users vu ON rm.AssignedVolunteer = vu.UserID
            WHERE rm.Status IN ('In Progress', 'Pending')
        ";

        $result = $this->conn->query($query);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
    public function updateRescueMissionStatus($missionID, $newStatus, $userID) {
        $stmt = $this->conn->prepare("
            UPDATE RescueMissions 
            SET Status = ?
            WHERE MissionID = ? AND AssignedVolunteer = ?
        ");
        $stmt->bind_param("sii", $newStatus, $missionID, $userID);
        return $stmt->execute();
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

        return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
    }

    public function getVolunteerCapabilities($userId) {
        $stmt = $this->conn->prepare("
            SELECT EmergencyRescue, ManageAdoption
            FROM VolunteerDetails
            WHERE UserID = ?
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
    }

    public function getTrainingAndStories() {
    $query = "
        SELECT ec.ContentID, ec.Title, ec.Description, ec.VideoPath, ec.UploadDate, ec.ContentType, u.FullName AS Uploader
        FROM EducationalContent ec
        INNER JOIN Users u ON ec.UploadedBy = u.UserID
        WHERE ec.ContentType IN ('VetTraining', 'VolunteerStory')
        ORDER BY ec.UploadDate DESC
    ";
    
    $result = $this->conn->query($query);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

    public function __destruct() {
        $this->conn->close();
    }
}
?>
