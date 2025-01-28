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


    // Fetch animals with the specified adoption status
    public function getAnimalsByStatus($status) {
        $sql = "SELECT AnimalID, Name, Species, Breed, Age, Gender, AnimalCondition, PicturePath 
                FROM Animal 
                WHERE AdoptionStatus = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $result = $stmt->get_result();

        $animals = [];
        while ($row = $result->fetch_assoc()) {
            $animals[] = $row;
        }

        $stmt->close();
        return $animals;
    }

    // Destructor to close the connection
    public function __destruct() {
        $this->conn->close();
    }
}
?>
