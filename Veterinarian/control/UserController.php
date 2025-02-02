<?php
include '../model/VetModel.php';

class UserController {
    private $veterinarianModel;

    public function __construct() {
        $this->veterinarianModel = new VetModel();
    }

    // For Registering a new Veterinarian
    public function registerVeterinarian($data) {
        return $this->veterinarianModel->addVeterinarian($data);
    }

    public function viewAllVeterinarians() {
        return $this->veterinarianModel->getAllVeterinarians();
    }

    public function HandleSearchById($id) {
        return $this->veterinarianModel->getVeterinarianById($id);
    }

    public function displayOngoingRescueMissions() {
        return $this->veterinarianModel->getOngoingRescueMissions();
    }

    public function updateMissionStatus($missionID, $newStatus) {
        return $this->veterinarianModel->updateMissionStatusDB($missionID, $newStatus); 
    }
}

$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    // Initialize an empty array to hold error messages
    $errorMessages = [];

    if (empty($password)) {
        $errorMessages[] = "Password cannot be empty.";
    }

    if (strlen($password) < 6) {
        $errorMessages[] = "Password must be at least 6 characters long.";
    }

    if (!preg_match('/[A-Z]/', $password)) {
        $errorMessages[] = "Password must contain at least one uppercase letter.";
    }

    if (!preg_match('/\d/', $password)) {
        $errorMessages[] = "Password must contain at least one number.";
    }

    if ($password !== $confirmPassword) {
        $errorMessages[] = "Passwords do not match.";
    }

    // Check if there are any errors and set them in session
    if (!empty($errorMessages)) {
        $_SESSION['error'] = implode(" ", $errorMessages);  // Combine all messages into one string
        header("Location: ../view/VeterinarianRegistration.php");
        exit;
    }


    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare data array
    $data = [
        'Email' => $email,
        'Password' => $hashedPassword,
        'ClinicName' => $_POST['ClinicName'],
        'Speciality' => $_POST['Speciality'],
        'FullName' => $_POST['FullName'],
        'Phone' => $_POST['Phone'],
        'ClinicAddress' => $_POST['ClinicAddress'],
        'LocationEnabled' => $_POST['LocationEnabled'],
        'License' => $_POST['License'],
        'Services' => $_POST['Services'],
        'WorkingHours' => $_POST['WorkingHours'],
    ];

    // Add veterinarian to the database
    $result = $userController->registerVeterinarian($data);
    
    if ($result) {
        $_SESSION['success'] = "Veterinarian registered successfully.";

        // Handle file uploads
        $uploadDir = "../uploads/medical-license/";

        // Move uploaded files to the target directory
        $vetLicensePath = $_FILES['VetLicensePath']['name'] ? $uploadDir . basename($_FILES['VetLicensePath']['name']) : null;
        $govIDPath = $_FILES['GovIDPath']['name'] ? $uploadDir . basename($_FILES['GovIDPath']['name']) : null;
        $trainingMaterialsPath = $_FILES['TrainingMaterialsPath']['name'] ? $uploadDir . basename($_FILES['TrainingMaterialsPath']['name']) : null;

        // Ensure files are uploaded
        if ($vetLicensePath) move_uploaded_file($_FILES['VetLicensePath']['tmp_name'], $vetLicensePath);
        if ($govIDPath) move_uploaded_file($_FILES['GovIDPath']['tmp_name'], $govIDPath);
        if ($trainingMaterialsPath) move_uploaded_file($_FILES['TrainingMaterialsPath']['tmp_name'], $trainingMaterialsPath);

        // Add paths to database (you should update this part inside `VetModel` for better separation)
        $vetLicensePath = $vetLicensePath ?: null;
        $govIDPath = $govIDPath ?: null;
        $trainingMaterialsPath = $trainingMaterialsPath ?: null;

        // Save the file paths in the database
        $this->veterinarianModel->updateVeterinarianFiles($result, $vetLicensePath, $govIDPath, $trainingMaterialsPath);

        // Redirect after success
        header("Location: ../view/VeterinarianHomepage.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to register veterinarian.";
        header("Location: ../view/VeterinarianRegistration.php");
        exit();
    }
}

// Handle search by ID
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vet_id'])) {
    $vetId = intval($_POST['vet_id']);
    $veterinarian = $userController->HandleSearchById($vetId);
    $message = $veterinarian ? "" : "No veterinarian found with ID $vetId.";
}

// Display ongoing rescue missions
$rescueMissions = $userController->displayOngoingRescueMissions();

// Handling mission status update
if (isset($_POST['missionID']) && isset($_POST['status'])) {
    $missionID = $_POST['missionID'];
    $status = $_POST['status'];
    $updateSuccess = $userController->updateMissionStatus($missionID, $status);
    echo $updateSuccess ? "success" : "failed";
}

?>
