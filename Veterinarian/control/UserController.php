<?php
include '../model/VetModel.php';
class UserController {
    private $veterinarianModel;

    public function __construct($veterinarianModel) {
        $this->veterinarianModel = $veterinarianModel;
    }

    public function viewAllVeterinarians() {
        $veterinarians = $this->veterinarianModel->getAllVeterinarians();
        return $veterinarians;
    }

    public function searchById($id) {
        return $this->veterinarianModel->getVeterinarianById($id);
    }

    public function getMissions() {
        return $this->veterinarianModel->getRescueMissions();
    }
}
?>
