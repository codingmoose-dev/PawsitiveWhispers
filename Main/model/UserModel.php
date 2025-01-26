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
    
    // Function to find the user by email
    public function findUserByEmail($email) {
        // Sanitize email
        $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);

        // List of tables and their primary key columns
        $tables = [
            'GeneralUsers' => 'GeneralUserID',
            'Volunteers' => 'VolunteerID',
            'Veterinarians' => 'VeterinarianID',
            'Benefactors' => 'BenefactorID',
        ];

        // Check each table for the email
        foreach ($tables as $table => $primaryKey) {
            $query = "SELECT $primaryKey, Password FROM $table WHERE Email = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $user['table'] = $table; // Include table name for identification

                // Log the user found and from which table
                error_log("User found in table: $table");

                return $user;
            } else {
                error_log("No user found in table: $table for email: $email");
            }
        }

        return null; // No user found
    }
        
    // Function to authenticate user by email/ID and password
    public function authenticateUser($emailOrId, $password) {
        // Sanitize input
        $emailOrId = filter_var(trim($emailOrId), FILTER_SANITIZE_STRING);

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

            // Bind the parameter twice (for both email and ID)
            $stmt->bind_param("ss", $emailOrId, $emailOrId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Verify the password
                if (password_verify($password, $row['Password'])) {
                    return $row; // User authenticated successfully
                } else {
                    error_log("Password mismatch for email/ID: $emailOrId");
                }
            }

            $stmt->close();
        }

        return false; // Return false if no matching user found
    }

    // Function to get available animals for adoption
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
