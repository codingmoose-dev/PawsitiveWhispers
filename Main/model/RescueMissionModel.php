<?php
class RescueMissionModel {
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

    public function createMission($missionName, $description, $reportedById, $location, $imagePath) {
        $sql = "INSERT INTO RescueMissions (MissionName, Description, ReportedBy, Location, ImagePath, Status, PriorityLevel) 
                VALUES (?, ?, ?, ?, ?, 'Pending', 'Medium')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssiss", $missionName, $description, $reportedById, $location, $imagePath);
        
        return $stmt->execute();
    }
}
?>