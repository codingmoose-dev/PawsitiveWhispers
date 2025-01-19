// Include the UserModel class
include_once '../model/user_model.php';

class UserController {
    private $userModel;

    public function __construct() {
        // Initialize the UserModel class
        $this->userModel = new UserModel();
    }

    // Function to display all users
    public function displayUsers() {
        $users = $this->userModel->fetchUsers();
        include 'view_user.php';
    }

    // Function to update user data
    public function updateUser($userId, $attribute, $newValue) {
        $updateSuccess = $this->userModel->updateUser($userId, $attribute, $newValue);
        if ($updateSuccess) {
            header('Location: ../view/view_user.php?success=update');
        } else {
            header('Location: ../view/view_user.php?error=update_failed');
        }
    }

    // Function to handle form submission
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
            $userId = filter_var($_POST['user_id'], FILTER_VALIDATE_INT);
            $attribute = htmlspecialchars($_POST['attribute']);
            $newValue = htmlspecialchars(trim($_POST['new_value']));

            // If valid, update the user
            if ($userId !== false && in_array($attribute, ['FullName', 'Email', 'Phone', 'Password', 'HomeAddress', 'CityStateCountry', 'LocationEnabled', 'EmergencyRescue', 'OrganizeCampaigns', 'ManageAdoption', 'Skills', 'ExperienceYears', 'Availability'])) {
                $this->updateUser($userId, $attribute, $newValue);
            }
        } else {
            // If no POST request, display users
            $this->displayUsers();
        }
    }
}
