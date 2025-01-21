class AnimalController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function index() {
    // Fetch available animals from the model
    $animals = $this->model->getAnimals();
    
    // Debugging the $animals array
    var_dump($animals); // Output the contents of $animals to the browser
    exit(); // Stop further execution so it doesn't interfere with the page rendering

    if ($animals) {
        require_once '../view/Adoption.php'; // Proceed to the view if data is available
    } else {
        echo "No animals available for adoption.";
    }
}

}