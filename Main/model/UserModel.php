<?php
class UserModel {
    private $conn;

    public function __construct() {
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "PawsitiveWellbeing";

        // Create a new MySQLi connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function authenticateUser($emailOrId, $password) {
        $queryTemplates = [
            "SELECT GeneralUserID, FullName, Password FROM GeneralUsers WHERE Email = ? OR GeneralUserID = ?",
            "SELECT VolunteerID, FullName, Password FROM Volunteers WHERE Email = ? OR VolunteerID = ?",
            "SELECT VeterinarianID, FullName, Password FROM Veterinarians WHERE Email = ? OR VeterinarianID = ?",
            "SELECT BenefactorID, FullName, Password FROM Benefactors WHERE Email = ? OR BenefactorID = ?"
        ];

        foreach ($queryTemplates as $query) {
            $stmt = $this->conn->prepare($query);
            if ($stmt === false) {
                die('MySQL prepare error: ' . $this->conn->error);
            }

            $stmt->bind_param("ss", $emailOrId, $emailOrId); // Bind email/ID twice
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) { 
                $row = $result->fetch_assoc();

                // Verify password
                if (password_verify($password, $row['Password'])) {
                    return $row; 
                }
            }
            $stmt->close();
        }

        return false; // Return false if no matching user found
    }

    public function getAnimals() {
        $sql = "SELECT Name, Species, Breed, Age, Gender, AnimalCondition, RescueDate, AdoptionStatus, PicturePath FROM Animal WHERE AdoptionStatus = 'Available'"; 
        $result = $this->conn->query($sql);
        $animals = [];
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $animals[] = $row;
            }
        }
        
        return $animals; // Ensure this is returning the data
    }    


    public function __destruct() {
        $this->conn->close();
    }
}
