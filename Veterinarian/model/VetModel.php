<?php

class VetModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "root", "", "PawsitiveWellbeing");
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    // Fetch all veterinarians
    public function getAllVeterinarians() {
        $query = "SELECT * FROM Veterinarians";
        $result = $this->db->query($query);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Fetch veterinarian by ID
    public function getVeterinarianById($id) {
        $query = "SELECT * FROM Veterinarians WHERE VeterinarianID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Close the database connection
    public function closeConnection() {
        $this->db->close();
    }
}
?>
