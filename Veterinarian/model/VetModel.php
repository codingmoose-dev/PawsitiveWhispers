<?php

class VetModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "PawsitiveWellbeing");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Fetch all veterinarians
    public function getAllVeterinarians() {
        $query = "SELECT * FROM Veterinarians";
        $result = $this->conn->query($query);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Fetch veterinarian by ID
    public function getVeterinarianById($id) {
        $query = "SELECT * FROM Veterinarians WHERE VeterinarianID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getRescueMissions() {
        $sql = "SELECT MissionID, MissionName, Description, Location, Status, PriorityLevel, RegisteredDate 
                FROM RescueMissions";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Close the database connection
    public function closeConnection() {
        $this->conn->close();
    }
}
?>
