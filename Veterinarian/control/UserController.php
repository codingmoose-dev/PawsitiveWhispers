<?php
include '../model/VetModel.php';

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
}

$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
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

?>
