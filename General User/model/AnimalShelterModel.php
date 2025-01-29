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
            $data['name'], 
            $data['species'], 
            $data['breed'], 
            $data['age'], 
            $data['gender'], 
            $data['animalCondition'], 
            $data['rescueDate'], 
            $data['adoptionStatus'], 
            $data['shelterID']
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
