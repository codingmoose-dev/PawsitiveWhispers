<?php
include '../model/VetModel.php';
session_start();
class UserController {
    private $veterinarianModel;

    public function __construct() {
        $this->veterinarianModel = new VetModel();
    }

    //For Registering a new Veterinarian
    public function registerVeterinarian($data) {
        return $this->veterinarianModel->addVeterinarian($data);
    }


    public function viewAllVeterinarians() {
        $veterinarians = $this->veterinarianModel->getAllVeterinarians();
        return $veterinarians;
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

    // ✅ Email Validation
    //if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
       // $_SESSION['error'] = "Invalid email format.";
       // header("Location: ../view/VeterinarianRegistration.php");
       // exit;
   // }

    // ✅ Password Validation (ADD THIS SECTION)
    if (empty($password)) {
        $_SESSION['error'] = "Password cannot be empty.";
        header("Location: ../view/VeterinarianRegistration.php");
        exit;
    }

    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters long.";
        header("Location: ../view/VeterinarianRegistration.php");
        exit;
    }

    if (!preg_match('/[A-Z]/', $password)) {
        $_SESSION['error'] = "Password must contain at least one uppercase letter.";
        header("Location: ../view/VeterinarianRegistration.php");
        exit;
    }

    if (!preg_match('/\d/', $password)) {
        $_SESSION['error'] = "Password must contain at least one number.";
        header("Location: ../view/VeterinarianRegistration.php");
        exit;
    }

    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: ../view/VeterinarianRegistration.php");
        exit;
    }

    // ✅ Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // ✅ Save veterinarian data in the database
    $stmt = $conn->prepare("INSERT INTO veterinarians (email, password, clinicname, speciality) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$email, $hashedPassword, $_POST['clinicname'], $_POST['speciality']])) {
        $_SESSION['success'] = "Veterinarian registration successful!";
        header("Location: ../view/VeterinarianLogin.php");
        exit;
    } else {
        $_SESSION['error'] = "Error: Registration failed.";
        header("Location: ../view/VeterinarianRegistration.php");
        exit;
    } 

    $uploadDir = "../uploads/medical-license/"; 

    $vetLicensePath = $_FILES['VetLicensePath']['name'] ? $uploadDir . basename($_FILES['VetLicensePath']['name']) : null;
    $govIDPath = $_FILES['GovIDPath']['name'] ? $uploadDir . basename($_FILES['GovIDPath']['name']) : null;
    $trainingMaterialsPath = $_FILES['TrainingMaterialsPath']['name'] ? $uploadDir . basename($_FILES['TrainingMaterialsPath']['name']) : null;

    // Move uploaded files to the target directory
    move_uploaded_file($_FILES['VetLicensePath']['tmp_name'], $vetLicensePath);
    move_uploaded_file($_FILES['GovIDPath']['tmp_name'], $govIDPath);
    move_uploaded_file($_FILES['TrainingMaterialsPath']['tmp_name'], $trainingMaterialsPath);

    $data = [
        'FullName' => $_POST['FullName'],
        'Email' => $_POST['Email'],
        'Phone' => $_POST['Phone'],
        'Password' => password_hash($_POST['Password'], PASSWORD_BCRYPT), 
        'ClinicAddress' => $_POST['ClinicAddress'],
        'LocationEnabled' => $_POST['LocationEnabled'],
        'License' => $_POST['License'],
        'ClinicName' => $_POST['ClinicName'],
        'Speciality' => $_POST['Speciality'],
        'Services' => $_POST['Services'],
        'WorkingHours' => $_POST['WorkingHours'],
        'VetLicensePath' => $vetLicensePath, 
        'GovIDPath' => $govIDPath,
        'TrainingMaterialsPath' => $trainingMaterialsPath,
        'HostTraining' => $_POST['HostTraining'],
    ];

    $result = $userController->registerVeterinarian($data);
    $message = $result ? "Veterinarian registered successfully." : "Failed to register veterinarian.";
    echo $message;
    // Redirect to homepage after successful registration
    if ($result) {
        header("Location: ../view/VeterinarianHomePage.php");
        exit(); 
    } else {
        echo "Failed to register veterinarian.";
    }
}


// Handling search by ID
$veterinarians = $userController->viewAllVeterinarians();
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
    if ($updateSuccess) {
        echo "success"; 
    } else {
        echo "failed";  
    }
}


?>
