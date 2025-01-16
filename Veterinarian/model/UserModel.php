<?php
class UserModel {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            throw new Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Get all users
    public function getAllUsers() {
        $sql = "SELECT * FROM veterinarians";
        $result = $this->conn->query($sql);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    // Get user by ID
    public function getUserByPrimaryKey($id) {
        $sql = "SELECT * FROM veterinarians WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Close the connection
    public function __destruct() {
        $this->conn->close();
    }
}
/*
class UserModel {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            throw new Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Get all users
    public function getAllUsers() {
        $sql = "SELECT * FROM veterinarians";
        $result = $this->conn->query($sql);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    // Get user by ID
    public function getUserByPrimaryKey($id) {
        $sql = "SELECT * FROM veterinarians WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Close the connection
    public function __destruct() {
        $this->conn->close();
    }
}*/
?>