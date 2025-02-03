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
            die("Database connection failed: " . $this->conn->connect_error);
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
            $query = "SELECT FullName, $primaryKey, Password FROM $table WHERE Email = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $stmt->close();

                // Verify password (hashed or plain)
                if (password_verify($password, $user['Password']) || $password === $user['Password']) {
                    $user['table'] = $table;
                    return $user;
                }
            }

            $stmt->close();
        }

        return null; // No user found in any table
    }

    // Fetch animals based on status (default: Available & Pending)
    public function getAnimalsByStatus($status = null) {
        if ($status) {
            $sql = "SELECT AnimalID, Name, Species, Breed, Age, Gender, AnimalCondition, PicturePath, AdoptionStatus 
                    FROM Animal 
                    WHERE AdoptionStatus = ?";
            $stmt = $this->conn->prepare($sql);
            
            if (!$stmt) {
                error_log("Error preparing getAnimalsByStatus query: " . $this->conn->error);
                return [];
            }

            $stmt->bind_param("s", $status);
        } else {
            $sql = "SELECT AnimalID, Name, Species, Breed, Age, Gender, AnimalCondition, PicturePath, AdoptionStatus 
                    FROM Animal 
                    WHERE AdoptionStatus IN ('Available', 'Pending')";
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

    // Update animal adoption status
    public function updateAnimalStatus($animalId, $status) {
        $sql = "UPDATE Animal SET AdoptionStatus = ? WHERE AnimalID = ?";
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

    // Destructor to close the connection
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
