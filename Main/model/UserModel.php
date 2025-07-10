<?php
class UserModel {
    private $conn;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "PawsitiveWellbeing";

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

    public function registerUser($userData) {
        $this->conn->begin_transaction();
        try {
            // Insert into Users table
            $query = "INSERT INTO Users 
                (FullName, Email, Phone, Password, HomeAddress, CityStateCountry, Role, ProfilePicturePath, SocialMediaLinks, EmailVerified)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param(
                "sssssssssi",
                $userData['FullName'],
                $userData['Email'],
                $userData['Phone'],
                $userData['Password'],
                $userData['HomeAddress'],
                $userData['CityStateCountry'],
                $userData['Role'],
                $userData['ProfilePicturePath'],
                $userData['SocialMediaLinks'],
                $userData['EmailVerified']
            );

            if (!$stmt->execute()) throw new Exception("User insert failed: " . $stmt->error);

            $userId = $stmt->insert_id;
            $stmt->close();

            // Insert into GeneralUserPreferences
            $prefQuery = "INSERT INTO GeneralUserPreferences (UserID, LocationEnabled, AdoptionNotifications, DonationCampaignNotifications, NewsletterSubscription)
                        VALUES (?, ?, ?, ?, ?)";
            $prefStmt = $this->conn->prepare($prefQuery);
            $prefStmt->bind_param(
                "iiiii",
                $userId,
                $userData['Preferences']['LocationEnabled'],
                $userData['Preferences']['AdoptionNotifications'],
                $userData['Preferences']['DonationCampaignNotifications'],
                $userData['Preferences']['NewsletterSubscription']
            );
            if (!$prefStmt->execute()) throw new Exception("Preferences insert failed: " . $prefStmt->error);
            $prefStmt->close();

            // Role-specific inserts
            switch ($userData['Role']) {
                case 'Volunteer':
                    $volStmt = $this->conn->prepare("INSERT INTO VolunteerDetails 
                        (UserID, LocationEnabled, EmergencyRescue, OrganizeCampaigns, ManageAdoption, Skills, ExperienceYears, Availability)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

                    $volStmt->bind_param(
                        "iiiiisis",
                        $userId,
                        $userData['Volunteer']['LocationEnabled'],
                        $userData['Volunteer']['EmergencyRescue'],
                        $userData['Volunteer']['OrganizeCampaigns'],
                        $userData['Volunteer']['ManageAdoption'],
                        $userData['Volunteer']['Skills'],
                        $userData['Volunteer']['ExperienceYears'],
                        $userData['Volunteer']['Availability']
                    );
                    if (!$volStmt->execute()) throw new Exception("Volunteer insert failed: " . $volStmt->error);
                    $volStmt->close();
                    break;

                case 'Veterinarian':
                    $vetStmt = $this->conn->prepare("INSERT INTO VeterinarianDetails
                        (UserID, ClinicName, ClinicAddress, LocationEnabled, License, Speciality, Services, WorkingHours,
                        VetLicensePath, GovIDPath, HostTraining, TrainingMaterialsPath)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    $vetStmt->bind_param(
                        "isssisssssss",
                        $userId,
                        $userData['Veterinarian']['ClinicName'],
                        $userData['Veterinarian']['ClinicAddress'],
                        $userData['Veterinarian']['LocationEnabled'],
                        $userData['Veterinarian']['License'],
                        $userData['Veterinarian']['Speciality'],
                        $userData['Veterinarian']['Services'],
                        $userData['Veterinarian']['WorkingHours'],
                        $userData['Veterinarian']['VetLicensePath'],
                        $userData['Veterinarian']['GovIDPath'],
                        $userData['Veterinarian']['HostTraining'],
                        $userData['Veterinarian']['TrainingMaterialsPath']
                    );
                    if (!$vetStmt->execute()) throw new Exception("Veterinarian insert failed: " . $vetStmt->error);
                    $vetStmt->close();
                    break;

                case 'Benefactor':
                    $benStmt = $this->conn->prepare("INSERT INTO BenefactorDetails
                        (UserID, OrganizationType, DonationType, PreferredCampaign, Availability, PaymentMethod,
                        SavePayment, SponsorEvents, NgoPartnership, AdditionalNotes)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    $benStmt->bind_param(
                        "isssssssss",
                        $userId,
                        $userData['Benefactor']['OrganizationType'],
                        $userData['Benefactor']['DonationType'],
                        $userData['Benefactor']['PreferredCampaign'],
                        $userData['Benefactor']['Availability'],
                        $userData['Benefactor']['PaymentMethod'],
                        $userData['Benefactor']['SavePayment'],
                        $userData['Benefactor']['SponsorEvents'],
                        $userData['Benefactor']['NgoPartnership'],
                        $userData['Benefactor']['AdditionalNotes']
                    );
                    if (!$benStmt->execute()) throw new Exception("Benefactor insert failed: " . $benStmt->error);
                    $benStmt->close();
                    break;
            }

            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            $this->conn->rollback();
            error_log("Registration failed: " . $e->getMessage());
            return $e->getMessage();
        }
    }

    // Find user from Users table
    public function findUserByEmail($email, $password) {
        $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);

        $query = "SELECT UserID, FullName, Email, Password, Role FROM Users WHERE Email = ?";
        $stmt = $this->conn->prepare($query);
        
        if (!$stmt) {
            error_log("Error preparing findUserByEmail query: " . $this->conn->error);
            return null;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Secure password verification
            if (password_verify($password, $user['Password']) || $password === $user['Password']) {
                return $user;
            }
        }

        $stmt->close();
        return null;
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
