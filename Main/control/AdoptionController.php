<?php
include '../model/UserModel.php';

class AnimalController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }
    public function getAllAnimals() {
        return $this->model->getAnimalsByStatus(); // Fetch both available and pending
    }
    

    public function updateAnimalStatus($animalId, $status) {
        $sql = "UPDATE Animal SET AdoptionStatus = ? WHERE AnimalID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $animalId);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['adopt_id'])) {
    $animalId = $_POST['adopt_id'];

    if ($animalController->updateAnimalStatus($animalId, 'Pending')) {
        echo "success";
    } else {
        echo "error";
    }
    exit;
}

?>