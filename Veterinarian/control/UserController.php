<?php

class UserController {
    private $veterinarianModel;

    public function __construct($veterinarianModel) {
        $this->veterinarianModel = $veterinarianModel;
    }

    // View all veterinarians and pass to the view
    public function viewAllVeterinarians() {
        $veterinarians = $this->veterinarianModel->getAllVeterinarians();
        global $veterinarians;
        global $message;
        $message = empty($veterinarians) ? "No veterinarians found." : "Select a veterinarian to view their details.";
    }

    // Search veterinarian by ID
    public function searchById() {
        $id = isset($_POST['vet_id']) ? $_POST['vet_id'] : null;
        if ($id) {
            $veterinarian = $this->veterinarianModel->getVeterinarianById($id);
            global $veterinarian;
            global $message;
            $message = $veterinarian ? "" : "Veterinarian not found.";
        } else {
            $message = "Please enter a valid ID.";
            $veterinarian = null;
        }
    }
}

?>
