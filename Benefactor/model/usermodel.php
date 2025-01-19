<?php
class UserModel {
    private $connection;

    public function __construct($servername, $username, $password, $dbname) {
        // Establish database connection using MySQLi
        $this->connection = new mysqli($servername, $username, $password, $dbname);

        // Check for connection error
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    // Get all benefactors from the database
    public function getAllBenefactors() {
        $query = "SELECT 
                    id, FullName, Email, Phone, Password, Address, OrganizationType, 
                    DonationType, PreferredCampaign, PaymentMethod, 
                    SavePayment, SponsorEvents, NgoPartnership, AdditionalNotes
                  FROM Benefactors"; 
        $stmt = $this->connection->prepare($query);
        
        if ($stmt === false) {
            die("Error preparing statement: " . $this->connection->error);
        }

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
        } else {
            return []; // Return empty array if query fails
        }
    }

    // Delete a user by primary key
    public function deleteUser($id) {
        $query = "DELETE FROM Benefactors WHERE id = ?"; 
        $stmt = $this->connection->prepare($query);
        
        if ($stmt === false) {
            die("Error preparing statement: " . $this->connection->error);
        }

        $stmt->bind_param("i", $id); // Bind the integer parameter
        return $stmt->execute(); // Return whether the execution was successful
    }

    // Close the database connection
    public function closeConnection() {
        $this->connection->close();
    }
}
?>
