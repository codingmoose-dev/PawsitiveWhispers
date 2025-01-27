<?php
include '../model/UserModel.php'; 
$animalController = new AnimalController();

class AnimalController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();  // Corrected to AnimalModel
    }

    public function index() {
        $animals = $this->model->getAnimals();  // Fetch animals from AnimalModel
    
        if ($animals) {
            include '../view/Adoption.php';  // Display animals
        } else {
            echo "No animals available for adoption.<br>";
        }
    }
}

?>