<?php
class UserModel {
    private $connection;

    public function __construct() {
        // Establish database connection using MySQLi
        $this->connection = new mysqli("localhost", "root", "", "pawsitivewellbeing");

        // Check for connection error
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getAllUsers() {
        $query = "SELECT 
                    id, full_name, email, phone, password, address, organization_type, 
                    donation_type, preferred_campaign, payment_method, save_payment_info, 
                    willing_to_sponsor, interested_in_partnership, captcha, terms_conditions, 
                    email_verified 
                  FROM animalcarebenefactors"; 
        $result = $this->connection->query($query);

        // Check if query was successful
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
        } else {
            return []; // Return empty array if query fails
        }
    }

    // Delete a user by primary key
    public function deleteUser($id) {
        $query = "DELETE FROM animalcarebenefactors WHERE id = ?"; 
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id); // Bind the integer parameter
        return $stmt->execute(); // Return whether the execution was successful
    }


    // Close the database connection
    public function closeConnection() {
        $this->connection->close();
    }
}
?>
