<?php
include '../model/UserModel.php';

class AnimalController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    // Fetch animals with AdoptionStatus = 'Available'
    public function getAvailableAnimals() {
        return $this->model->getAnimalsByStatus('Available');
    }
}
?>