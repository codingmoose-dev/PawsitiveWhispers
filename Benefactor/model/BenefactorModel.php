<?php

class BenefactorModel {

    private $conn;

    public function __construct() {
        $this->conn = $this->openConn();
    }

    // Method to open the connection
    private function openConn() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "PawsitiveWellbeing"; 
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    // Function to register a benefactor
    public function registerBenefactor($fullName, $email, $phone, $password, $address, $organizationType, $donationType, $preferredCampaign, $availability, $paymentMethod, $savePayment, $sponsorEvents, $ngoPartnership, $additionalNotes) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO Benefactors (FullName, Email, Phone, Password, Address, OrganizationType, DonationType, PreferredCampaign, Availability, PaymentMethod, SavePayment, SponsorEvents, NgoPartnership, AdditionalNotes) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssssss", $fullName, $email, $phone, $hashedPassword, $address, $organizationType, $donationType, $preferredCampaign, $availability, $paymentMethod, $savePayment, $sponsorEvents, $ngoPartnership, $additionalNotes);
        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }

    // Function to check if the email already exists
    public function isEmailExists($email) {
        $stmt = $this->conn->prepare("SELECT Email FROM Benefactors WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0; // Return true if email exists, false otherwise
    }


    // Get all benefactors from the database
    public function getAllBenefactors() {
        $query = "SELECT 
                    BenefactorID, FullName, Email, Phone, Password, Address, OrganizationType, 
                    DonationType, PreferredCampaign, PaymentMethod, 
                    SavePayment, SponsorEvents, NgoPartnership, AdditionalNotes
                  FROM Benefactors"; 
        $stmt = $this->conn->prepare($query);
        
        if ($stmt === false) {
            die("Error preparing statement: " . $this->conn->error);
        }

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
        } else {
            return []; // Return empty array if query fails
        }
    }


    // Function to delete a user based on BenefactorID
    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM Benefactors WHERE BenefactorID = ?");
        $stmt->bind_param("i", $id); 
        $stmt->execute();

        // Return true if any row was affected, otherwise false
        return $stmt->affected_rows > 0;
    }

    public function closeConnection() {
        if (isset($this->conn)) {
            $this->conn->close();
        }
    }
}
?>
