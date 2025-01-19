<?php

class VetModel {
    private $db;

    // Constructor to initialize the database connection
    public function __construct() {
        $this->db = new mysqli("localhost", "root", "", "PawsitiveWellbeing");

        // Check if the connection failed
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    // Fetch all veterinarians from the database
    public function getAllVeterinarians() {
        try {
            $query = "SELECT * FROM Veterinarians";
            $result = $this->db->query($query);

            // Check if query was successful and rows are returned
            if ($result && $result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC); // Return results as an associative array
            } else {
                return []; // Return an empty array if no veterinarians found
            }
        } catch (Exception $e) {
            // Log the error message
            echo "Error: " . $e->getMessage();
            return []; // Return empty array on error
        }
    }

    // Fetch a specific veterinarian based on ID
    public function getVeterinarianById($id) {
        try {
            $query = "SELECT * FROM Veterinarians WHERE VeterinarianID = ?";
            $stmt = $this->db->prepare($query);

            // Ensure the ID is an integer
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Return fetched result or null if not found
            return $result->fetch_assoc() ? $result->fetch_assoc() : null;
        } catch (Exception $e) {
            // Log error message
            echo "Error: " . $e->getMessage();
            return null; // Return null if an error occurs
        }
    }

    // Close the database connection
    public function closeConnection() {
        $this->db->close();
    }
}
?>
