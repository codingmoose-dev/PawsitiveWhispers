class UserModel {
    private $conn;

    public function __construct() {
        $servername = "localhost"; 
        $username = "root"; 
        $password = ""; 
        $dbname = "PawsitiveWellbeing";

        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function fetchUsers() {
        $sql = "SELECT * FROM Volunteers";
        $result = $this->conn->query($sql);
        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }

    public function updateUser($VolunteerID, $attribute, $newValue) {
        // Allowed attributes for update
        $allowedAttributes = [
            'FullName', 'Email', 'Phone', 'Password', 'HomeAddress',
            'CityStateCountry', 'LocationEnabled', 'EmergencyRescue', 
            'OrganizeCampaigns', 'ManageAdoption', 'Skills', 
            'ExperienceYears', 'Availability'
        ];

        // Validate that the attribute is allowed
        if (!in_array($attribute, $allowedAttributes)) {
            return false;
        }

        // Prepare and execute the update statement
        $sql = "UPDATE Volunteers SET $attribute = ? WHERE VolunteerID = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        
        // Bind parameters and execute
        $stmt->bind_param('si', $newValue, $VolunteerID);
        return $stmt->execute();
    }

    public function __destruct() {
        $this->conn->close();
    }
}
