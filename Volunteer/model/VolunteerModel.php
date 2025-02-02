<?php
class VolunteerModel {
    private $connection;

    public function __construct() {
        $this->connection = new mysqli("localhost", "root", "", "PawsitiveWellbeing");

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }


    // Register a new volunteer
    public function registerVolunteer($fullName, $email, $phone, $password, $homeAddress, $cityStateCountry, $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, $experienceYears, $availability) {
        $query = "INSERT INTO Volunteers (FullName, Email, Phone, Password, HomeAddress, CityStateCountry, LocationEnabled, EmergencyRescue, OrganizeCampaigns, ManageAdoption, Skills, ExperienceYears, Availability) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = $this->connection->prepare($query)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  
            $stmt->bind_param('ssssssssssssi', $fullName, $email, $phone, $hashedPassword, $homeAddress, $cityStateCountry, $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, $experienceYears, $availability);
            return $stmt->execute();
        } else {
            return false;
        }
    }    

    public function getOngoingRescueMissions() {
        $query = "SELECT * FROM RescueMissions WHERE Status IN ('In Progress', 'Pending')";
        $result = $this->connection->query($query);
        $rescuemissions = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rescuemissions[] = $row;
            }
        }
        return $rescuemissions;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function getAllVolunteers() {
        $query = "SELECT VolunteerID, FullName, Email, Phone, Password, HomeAddress, CityStateCountry, LocationEnabled, 
                        EmergencyRescue, OrganizeCampaigns, ManageAdoption, Skills, ExperienceYears, Availability 
                  FROM Volunteers";
        return $this->connection->query($query);
    }

    public function updateVolunteer($userId, $fullName, $email, $phone, $password, $homeAddress, $cityStateCountry, 
    $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, 
    $skills, $experienceYears, $availability) {
    // Check if Skills is empty, if so set a default value
    if (empty($skills)) {
    $skills = "Not provided"; // Default value if no skills are provided
    }

    $updateQuery = "UPDATE Volunteers SET FullName=?, Email=?, Phone=?, Password=?, HomeAddress=?, CityStateCountry=?, 
    LocationEnabled=?, EmergencyRescue=?, OrganizeCampaigns=?, ManageAdoption=?, Skills=?, 
    ExperienceYears=?, Availability=? WHERE VolunteerID=?";

    // Prepare the statement
    if ($stmt = $this->connection->prepare($updateQuery)) {
    // Bind parameters with proper data types
    $stmt->bind_param('ssssssiiiiissi', $fullName, $email, $phone, $password, $homeAddress, $cityStateCountry, 
    $locationEnabled, $emergencyRescue, $organizeCampaigns, $manageAdoption, $skills, 
    $experienceYears, $availability, $userId);

    // Execute the query
    return $stmt->execute();
    }
    return false;
    }


    public function getVolunteerByID($volunteerID) {
        // SQL query to fetch volunteer details by ID
        $sql = "SELECT * FROM Volunteers WHERE VolunteerID = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $volunteerID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $volunteer = null;
        if ($result->num_rows > 0) {
            $volunteer = $result->fetch_assoc(); // Fetch the volunteer details
        }

        $stmt->close();
        return $volunteer;
    }

    public function __destruct() {
        $this->connection->close(); // Close the database connection
    }

}
?>