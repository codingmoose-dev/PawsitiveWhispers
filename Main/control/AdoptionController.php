<?php
require_once '../model/UserModel.php';

class AnimalController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function index() {
        $animals = $this->model->getAnimals();
    
        if ($animals) {
            echo "<pre>";
            print_r($animals); // Output the array of animals for debugging
            echo "</pre>";
            require_once '../view/Adoption.php';
        } else {
            echo "No animals available for adoption.<br>";
        }
    }
    
}
?>