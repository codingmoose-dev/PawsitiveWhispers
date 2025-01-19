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
            die('Connection failed: ' . self::$connection->connect_error);
        }
    }

    // Fetch all users from the database
    public function getAllUsers() {
        $query = "SELECT VolunteerID, FullName, Email, Phone, Password, HomeAddress, CityStateCountry, LocationEnabled, EmergencyRescue, OrganizeCampaigns, ManageAdoption, Skills, ExperienceYears, Availability FROM Volunteers";
        $result = self::$connection->query($query);
        if ($result) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            var_dump($users);  // Debug: Display the result to check if any data is returned
            return $users;
        } else {
            die('Error fetching users: ' . self::$connection->error);
        }
    }

    // Update user information with all fields (including password)
    public function updateUser($id, $fullName, $email, $phone, $password = null, $homeAddress, $cityStateCountry, $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, $experienceYears, $availability) {
        if ($password !== null) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = self::$connection->prepare("UPDATE Volunteers SET FullName = ?, Email = ?, Phone = ?, Password = ?, HomeAddress = ?, CityStateCountry = ?, LocationEnabled = ?, EmergencyRescue = ?, OrganizeCampaigns = ?, ManageAdoption = ?, Skills = ?, ExperienceYears = ?, Availability = ? WHERE VolunteerID = ?");
            $stmt->bind_param("sssssssssssssi", $fullName, $email, $phone, $hashedPassword, $homeAddress, $cityStateCountry, $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, $experienceYears, $availability, $id);
        } else {
            $stmt = self::$connection->prepare("UPDATE Volunteers SET FullName = ?, Email = ?, Phone = ?, HomeAddress = ?, CityStateCountry = ?, LocationEnabled = ?, EmergencyRescue = ?, OrganizeCampaigns = ?, ManageAdoption = ?, Skills = ?, ExperienceYears = ?, Availability = ? WHERE VolunteerID = ?");
            $stmt->bind_param("ssssssssssssi", $fullName, $email, $phone, $homeAddress, $cityStateCountry, $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, $experienceYears, $availability, $id);
        }

        if (!$stmt->execute()) {
            die('Error executing statement: ' . $stmt->error);
        }

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

