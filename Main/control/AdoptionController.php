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
        return $this->model->updateAnimalStatus($animalId, $status); // Delegate update to UserModel
    }
}

// Create an instance of AnimalController
$animalController = new AnimalController();

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
