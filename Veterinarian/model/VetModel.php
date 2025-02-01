<?php

class VetModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "PawsitiveWellbeing");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Add a new veterinarian
        // Add a new veterinarian (register)
        public function addVeterinarian($data) {
            $query = "INSERT INTO Veterinarians (FullName, Email, Phone, Password, ClinicAddress, LocationEnabled, License, ClinicName, Speciality, Services, WorkingHours, VetLicensePath, GovIDPath, TrainingMaterialsPath, HostTraining) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param(
                'sssssiissssssss',
                $data['FullName'],
                $data['Email'],
                $data['Phone'],
                $data['Password'],
                $data['ClinicAddress'],
                $data['LocationEnabled'],
                $data['License'],
                $data['ClinicName'],
                $data['Speciality'],
                $data['Services'],
                $data['WorkingHours'],
                $data['VetLicensePath'],
                $data['GovIDPath'],
                $data['TrainingMaterialsPath'],
                $data['HostTraining']
            );
    
            return $stmt->execute();
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
        $stmt = $this->conn->prepare($query);// Prepare the statement to protect against SQL injection
        $stmt->bind_param("i", $id); // Bind the parameter to the query (in this case, an integer)
        $stmt->execute(); // Execute the query
        $result = $stmt->get_result(); // Get the result from the query
        
        if ($result->num_rows > 0) {
            $veterinarian = $result->fetch_assoc(); // Fetch the row as an associative array
        } else {
            $veterinarian = null; // No veterinarian found
        }
        
        return $veterinarian;
    }
    

    public function getOngoingRescueMissions() {
        $query = "SELECT * FROM RescueMissions WHERE Status IN ('In Progress', 'Pending')";
        $result = $this->conn->query($query);
        $rescuemissions = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rescuemissions[] = $row;
            }
        }
        return $rescuemissions;
    }

    public function getConnection() {
        return $this->conn;
    }
}

?>
