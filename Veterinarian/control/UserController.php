<?php
include '../model/VetModel.php';

class UserController {
    private $veterinarianModel;

    public function __construct() {
        $this->veterinarianModel = new VetModel();
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
$veterinarians = $userController->viewAllVeterinarians();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vet_id'])) {
    $vetId = intval($_POST['vet_id']);
    $veterinarian = $userController->HandleSearchById($vetId);
    $message = $veterinarian ? "" : "No veterinarian found with ID $vetId.";
}

?>
