<?php
class UserModel {
    private $connection;

    public function __construct() {
        $this->connection = new mysqli("localhost", "root", "", "PawsitiveWellbeing");

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
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

    }
?>