<?php
class AnimalModel {
    private $conn;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "PawsitiveWhispers";

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

    public function getAnimalsByStatus($status = null) {
        if ($status) {
            $sql = "SELECT AnimalID, Name, Species, Breed, Age, Gender, AnimalCondition, PicturePath, AdoptionStatus, RescueDate, ShelterID
                    FROM Animals
                    WHERE AdoptionStatus = ?";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                error_log("Error preparing getAnimalsByStatus query: " . $this->conn->error);
                return [];
            }

            $stmt->bind_param("s", $status);
        } else {
            // Fetch animals with AdoptionStatus 'Available', 'Pending', or 'UnderCare' by default (include new status)
            $sql = "SELECT AnimalID, Name, Species, Breed, Age, Gender, AnimalCondition, PicturePath, AdoptionStatus, RescueDate, ShelterID
                    FROM Animals
                    WHERE AdoptionStatus IN ('Available', 'Pending', 'UnderCare')";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                error_log("Error preparing getAnimalsByStatus query: " . $this->conn->error);
                return [];
            }
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $animals = [];
        while ($row = $result->fetch_assoc()) {
            $animals[] = $row;
        }

        $stmt->close();
        return $animals;
    }

    public function updateAnimalStatus($animalId, $status) {
        $allowedStatuses = ['Available', 'Adopted', 'Pending', 'UnderCare'];

        if (!in_array($status, $allowedStatuses)) {
            error_log("Invalid adoption status: " . $status);
            return false;
        }

        $sql = "UPDATE Animals SET AdoptionStatus = ? WHERE AnimalID = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            error_log("Error preparing updateAnimalStatus query: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param("si", $status, $animalId);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
