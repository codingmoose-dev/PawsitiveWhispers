<?php

class VetModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "PawsitiveWhispers");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addVeterinarian($data) {
        $this->conn->begin_transaction();

        try {
            $hashedPassword = password_hash($data['Password'], PASSWORD_DEFAULT);

            $stmtUser = $this->conn->prepare("
                INSERT INTO Users (FullName, Email, Phone, Password, HomeAddress, CityStateCountry, Role, ProfilePicturePath, SocialMediaLinks, EmailVerified)
                VALUES (?, ?, ?, ?, ?, ?, 'Veterinarian', ?, ?, 0)
            ");

            $homeAddress = $data['ClinicAddress'] ?? '';
            $cityStateCountry = $data['CityStateCountry'] ?? '';
            $profilePicturePath = $data['ProfilePicturePath'] ?? null;
            $socialMediaLinks = $data['SocialMediaLinks'] ?? null;

            $stmtUser->bind_param(
                "ssssssss",
                $data['FullName'],
                $data['Email'],
                $data['Phone'],
                $hashedPassword,
                $homeAddress,
                $cityStateCountry,
                $profilePicturePath,
                $socialMediaLinks
            );

            $stmtUser->execute();
            $userId = $this->conn->insert_id;
            $stmtUser->close();

            $stmtVet = $this->conn->prepare("
                INSERT INTO VeterinarianDetails
                (UserID, ClinicName, ClinicAddress, LocationEnabled, License, Speciality, Services, WorkingHours, VetLicensePath, GovIDPath, HostTraining, TrainingMaterialsPath)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $locationEnabled = isset($data['LocationEnabled']) ? (int)$data['LocationEnabled'] : 1;
            $hostTraining = $data['HostTraining'] ?? 'No';

            $stmtVet->bind_param(
                "ississssssss",
                $userId,
                $data['ClinicName'],
                $data['ClinicAddress'],
                $locationEnabled,
                $data['License'],
                $data['Speciality'],
                $data['Services'],
                $data['WorkingHours'],
                $data['VetLicensePath'],
                $data['GovIDPath'],
                $hostTraining,
                $data['TrainingMaterialsPath']
            );

            $stmtVet->execute();
            $stmtVet->close();

            $stmtPrefs = $this->conn->prepare("INSERT INTO GeneralUserPreferences (UserID) VALUES (?)");
            $stmtPrefs->bind_param("i", $userId);
            $stmtPrefs->execute();
            $stmtPrefs->close();

            $this->conn->commit();
            return $userId;

        } catch (Exception $e) {
            $this->conn->rollback();
            return "Error: " . $e->getMessage();
        }
    }

    public function getAllVeterinarians() {
        $query = "
            SELECT u.UserID, u.FullName, u.Email, u.Phone, u.ProfilePicturePath, 
                   v.ClinicName, v.ClinicAddress, v.LocationEnabled, v.License, v.Speciality, 
                   v.Services, v.WorkingHours, v.VetLicensePath, v.GovIDPath, v.HostTraining, v.TrainingMaterialsPath
            FROM Users u
            INNER JOIN VeterinarianDetails v ON u.UserID = v.UserID
            WHERE u.Role = 'Veterinarian'
        ";
        $result = $this->conn->query($query);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function getVeterinarianById($userId) {
        $stmt = $this->conn->prepare("
            SELECT u.UserID, u.FullName, u.Email, u.Phone, u.ProfilePicturePath, 
                   v.ClinicName, v.ClinicAddress, v.LocationEnabled, v.License, v.Speciality, 
                   v.Services, v.WorkingHours, v.VetLicensePath, v.GovIDPath, v.HostTraining, v.TrainingMaterialsPath
            FROM Users u
            INNER JOIN VeterinarianDetails v ON u.UserID = v.UserID
            WHERE u.UserID = ? AND u.Role = 'Veterinarian'
            LIMIT 1
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function getOngoingRescueMissions() {
        $query = "SELECT * FROM RescueMissions WHERE Status IN ('In Progress', 'Pending')";
        $result = $this->conn->query($query);

        $missions = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $missions[] = $row;
            }
        }
        return $missions;
    }

    public function updateMissionStatusDB($missionID, $newStatus) {
        $stmt = $this->conn->prepare("UPDATE RescueMissions SET Status = ? WHERE MissionID = ?");
        $stmt->bind_param('si', $newStatus, $missionID);
        return $stmt->execute();
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>