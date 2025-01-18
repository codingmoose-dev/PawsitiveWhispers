<?php

class UserModel {
    private $conn;

    public function __construct() {
        // Database connection details
        $servername = "localhost"; 
        $username = "root"; 
        $password = ""; 
        $dbname = "pawsitivewellbeing";

        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function fetchUsersFromDatabase() {
        // Define the query to fetch user data with the updated attributes
        $sql = "SELECT id, FullName, Email, Phone, Password, HomeAddress, CityStateCountry, LocationEnabled, EmergencyRescue, OrganizeCampaigns, ManageAdoption, Skills, ExperienceYears, Availability FROM animalcarevolunteer";

        // Execute the query
        $result = $this->conn->query($sql);

        // Check if there are any records in the database
        if ($result->num_rows > 0) {
            // Fetch all records
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            return $users;
        } else {
            return [];
        }
    }
    
    public function updateUserAttribute($userId, $attribute, $newValue) {
        $validAttributes = [
            'FullName', 'Email', 'Phone', 'Password', 'HomeAddress', 'CityStateCountry',
            'LocationEnabled', 'EmergencyRescue', 'OrganizeCampaigns', 'ManageAdoption', 
            'Skills', 'ExperienceYears', 'Availability'
        ];
    
        if (in_array($attribute, $validAttributes)) {
            $sql = "UPDATE animalcarevolunteer SET $attribute = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            if ($stmt === false) {
                // Error preparing the statement
                return false;
            }
            $stmt->bind_param('si', $newValue, $userId);
            if ($stmt->execute()) {
                return true;  // Successful update
            } else {
                // Error executing the statement
                return false;
            }
        }
        return false;  // Invalid attribute
    }
    
    public function __destruct() {
        // Close the database connection
        $this->conn->close();
    }
}
?>
