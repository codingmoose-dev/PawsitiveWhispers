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

    // Find user by email and verify password
    public function findUserByEmail($email, $password) {
        $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);

        // Tables with their primary keys
        $tables = [
            'GeneralUsers' => 'GeneralUserID',
            'Volunteers' => 'VolunteerID',
            'Veterinarians' => 'VeterinarianID',
            'Benefactors' => 'BenefactorID',
        ];

        foreach ($tables as $table => $primaryKey) {
            $query = "SELECT $primaryKey, Password FROM $table WHERE Email = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // Verify password (either hashed or plain)
                if (password_verify($password, $user['Password']) || $password === $user['Password']) {
                    $user['table'] = $table;
                    error_log("User found in table: $table");
                    return $user;
                } else {
                    error_log("Password mismatch for table: $table");
                }
            }
        }

        return null; // No user found in any table
    }

    
    public function getAnimals() {
        $sql = "SELECT Name, Species, Breed, Age, Gender, AnimalCondition, RescueDate, AdoptionStatus, PicturePath 
                FROM Animal 
                WHERE AdoptionStatus = 'Available'";
        
        $result = $this->conn->query($sql);
        
        if ($result === false) {
            die('Error executing query: ' . $this->conn->error);
        }
    
        $animals = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $animals[] = $row;
            }
        }
        return $animals;
    }
    
    
    // Authenticate user with email/ID and password
    public function authenticateUser($emailOrId, $password) {
        $emailOrId = filter_var(trim($emailOrId), FILTER_SANITIZE_STRING);

        $queryTemplates = [
            "SELECT GeneralUserID, FullName, Password FROM GeneralUsers WHERE Email = ? OR GeneralUserID = ?",
            "SELECT VolunteerID, FullName, Password FROM Volunteers WHERE Email = ? OR VolunteerID = ?",
            "SELECT VeterinarianID, FullName, Password FROM Veterinarians WHERE Email = ? OR VeterinarianID = ?",
            "SELECT BenefactorID, FullName, Password FROM Benefactors WHERE Email = ? OR BenefactorID = ?"
        ];

        foreach ($queryTemplates as $query) {
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ss", $emailOrId, $emailOrId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Allow plain text or hashed password verification
                if ($password === $row['Password'] || password_verify($password, $row['Password'])) {
                    return $row;
                }
            }

            $stmt->close();
        }

        return false;
    }

    // Destructor to close the connection
    public function __destruct() {
        $this->conn->close();
    }
}
?>
