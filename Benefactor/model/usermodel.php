<?php

class UserModel {
    private $conn;

    public function __construct() {
        // Database connection details
        $servername = "localhost"; 
        $username = "root"; 
        $password = ""; 
        $dbname = "PawsitiveWellbeing";

        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function fetchBenefactorsFromDatabase() {
        // Define the query to fetch benefactor data
        $sql = "SELECT 
                    FullName, 
                    Email, 
                    Phone, 
                    Password, 
                    Address, 
                    OrganizationType, 
                    DonationType, 
                    PreferredCampaign, 
                    Availability, 
                    PaymentMethod, 
                    SavePayment, 
                    SponsorEvents, 
                    NgoPartnership, 
                    AdditionalNotes 
                FROM Benefactors";

        // Execute the query
        $result = $this->conn->query($sql);

        // Check if there are any records in the database
        if ($result->num_rows > 0) {
            // Fetch all records
            $benefactors = [];
            while ($row = $result->fetch_assoc()) {
                $benefactors[] = $row;
            }
            return $benefactors;
        } else {
            return [];
        }
    }

    public function updateBenefactorAttribute($email, $attribute, $newValue) {
        $validAttributes = [
            'FullName', 'Email', 'Phone', 'Password', 'Address',
            'OrganizationType', 'DonationType', 'PreferredCampaign',
            'Availability', 'PaymentMethod', 'SavePayment', 
            'SponsorEvents', 'NgoPartnership', 'AdditionalNotes'
        ];

        if (in_array($attribute, $validAttributes)) {
            $sql = "UPDATE Benefactors SET $attribute = ? WHERE Email = ?";
            $stmt = $this->conn->prepare($sql);
            if ($stmt === false) {
                // Error preparing the statement
                return false;
            }
            $stmt->bind_param('ss', $newValue, $email); // Use Email as the identifier
            if ($stmt->execute()) {
                return true;  // Successful update
            } else {
                // Error executing the statement
                return false;
            }
        }
        return false;  // Invalid attribute
    }

    public function deleteBenefactorById($id) {
        $sql = "DELETE FROM Benefactors WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('i', $id); // Bind the ID as an integer
        return $stmt->execute();
    }
    

    public function __destruct() {
        // Close the database connection
        $this->conn->close();
    }
}
?>
