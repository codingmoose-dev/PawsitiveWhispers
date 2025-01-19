<?php
class UserModel {
    private static $connection;

    // Constructor to connect to the database
    public function __construct() {
        if (!self::$connection) {
            self::connect();
        }
    }

    // Connect to the database
    private static function connect() {
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'PawsitiveWellbeing';

        self::$connection = new mysqli($hostname, $username, $password, $dbname);

        // Check for connection errors
        if (self::$connection->connect_error) {
            throw new Exception('Connection failed: ' . self::$connection->connect_error);
        }
    }

    // Get all users with pagination
    public function getAllUsers($limit = 10, $offset = 0) {
        // Modify the query to include LIMIT and OFFSET for pagination
        $query = "SELECT VolunteerID, FullName, Email, Phone, Password, HomeAddress, CityStateCountry, LocationEnabled, EmergencyRescue, OrganizeCampaigns, ManageAdoption, Skills, ExperienceYears, Availability FROM Volunteers LIMIT ? OFFSET ?";
        
        $stmt = self::$connection->prepare($query);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result) {
            while ($user = $result->fetch_assoc()) {
                yield $user;
            }
            
            // Free the result set after usage
            $result->free();
        } else {
            error_log("Query failed: " . self::$connection->error);
            die('Error fetching users: ' . self::$connection->error);
        }
        
        // Close the prepared statement
        $stmt->close();
    }

    // Update user information with all fields (including password)
    public function updateUser($id, $fullName, $email, $phone, $password = null, $homeAddress, $cityStateCountry, $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, $experienceYears, $availability) {
        $stmt = self::$connection->prepare(
            $password !== null ?
            "UPDATE Volunteers SET FullName = ?, Email = ?, Phone = ?, Password = ?, HomeAddress = ?, CityStateCountry = ?, LocationEnabled = ?, EmergencyRescue = ?, OrganizeCampaigns = ?, ManageAdoption = ?, Skills = ?, ExperienceYears = ?, Availability = ? WHERE VolunteerID = ?" :
            "UPDATE Volunteers SET FullName = ?, Email = ?, Phone = ?, HomeAddress = ?, CityStateCountry = ?, LocationEnabled = ?, EmergencyRescue = ?, OrganizeCampaigns = ?, ManageAdoption = ?, Skills = ?, ExperienceYears = ?, Availability = ? WHERE VolunteerID = ?"
        );

        if ($password !== null) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("sssssssssssssi", $fullName, $email, $phone, $hashedPassword, $homeAddress, $cityStateCountry, $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, $experienceYears, $availability, $id);
        } else {
            $stmt->bind_param("ssssssssssssi", $fullName, $email, $phone, $homeAddress, $cityStateCountry, $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, $experienceYears, $availability, $id);
        }

        if (!$stmt->execute()) {
            throw new Exception('Error executing statement: ' . $stmt->error);
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Destructor to ensure connection is closed
    public function __destruct() {
        if (self::$connection) {
            self::$connection->close();
        }
    }
}
?>
