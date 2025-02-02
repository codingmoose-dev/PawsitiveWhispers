<?php

class AnimalShelterModel {
    private $db;

    public function __construct() {
        // Database connection setup
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "PawsitiveWellbeing";

        $this->db = new mysqli($host, $username, $password, $dbname);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    // Add a new animal record
    public function addAnimal($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO Animal (Name, Species, Breed, Age, Gender, AnimalCondition, RescueDate, AdoptionStatus, ShelterID) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param(
            "sssissssi",
            $data['Name'], 
            $data['Species'], 
            $data['Breed'], 
            $data['Age'], 
            $data['Gender'], 
            $data['AnimalCondition'], 
            $data['RescueDate'], 
            $data['AdoptionStatus'], 
            $data['ShelterID']
        );

        return $stmt->execute();
    }

    // Fetch all shelters from the database
    public function getAllShelters() {
        $result = $this->db->query("SELECT ShelterID, Name FROM Shelter");
        return $result->fetch_all(MYSQLI_ASSOC); // Return as associative array
    }
}
?>
