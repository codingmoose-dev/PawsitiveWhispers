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

    public function getOngoingRescueMissions() {
        $query = "SELECT * FROM RescueMissions WHERE Status IN ('In Progress', 'Pending')";
        $result = $this->connection->query($query);
        $rescuemissions = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rescuemissions[] = $row;
            }
        }
        return $rescuemissions;
    }

    public function getConnection() {
        return $this->connection;
    }

}
?>
