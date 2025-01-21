class AnimalController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }
    public function index() {
    $animals = $this->model->getAnimals();

    // Debugging the $animals array
    var_dump($animals); // This will print the content of the $animals array
    
    if ($animals) {
        require_once '../view/Adoption.php';
    } else {
        echo "No animals available for adoption.";
    }
    
    }
}