<?php
class UserModel {
    private $conn;

    // Constructor to establish database connection
    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "PawsitiveWellbeing";
    
        $this->conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    
    // Fetch user from the specified table by email or ID
    public function fetchUser($table, $idField, $emailOrId) {
        $query = "SELECT * FROM $table WHERE Email = ? OR $idField = ?";
        $stmt = $this->conn->prepare($query);
    
        if ($stmt === false) {
            error_log("MySQL prepare error: " . $this->conn->error);
            return false;
        }
    
        $stmt->bind_param("ss", $emailOrId, $emailOrId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
    
        $stmt->close();
        return false;
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
        
        if (!$result) {
            die('Error executing query: ' . $this->conn->error); // Debugging SQL errors
        }
        
        $animals = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $animals[] = $row;
            }
        }
        
        // Debug output
        var_dump($animals);
        exit(); // Stop further execution to test the output
        
        return $animals;
    }

    // Destructor to close the connection
    public function __destruct() {
        $this->conn->close();
    }
}
?>
