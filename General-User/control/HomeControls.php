<?php
include '../model/AnimalShelterModel.php';

class AnimalShelterController
{
    private $model;

    public function __construct()
    {
        $this->model = new AnimalShelterModel();
    }

    public function handlePostRequest()
    {
        $errors = [];

        if (!isset($_POST['Name']) || empty($_POST['Name'])) {
            $errors[] = 'Name is required.';
        }
        if (!isset($_POST['Species']) || empty($_POST['Species'])) {
            $errors[] = 'Species is required.';
        }
        if (!isset($_POST['Breed']) || empty($_POST['Breed'])) {
            $errors[] = 'Breed is required.';
        }
        if (!isset($_POST['Age']) || empty($_POST['Age'])) {
            $errors[] = 'Age is required.';
        }
        if (!isset($_POST['Gender']) || empty($_POST['Gender'])) {
            $errors[] = 'Gender is required.';
        }
        if (!isset($_POST['AnimalCondition']) || empty($_POST['AnimalCondition'])) {
            $errors[] = 'Animal condition is required.';
        }
        if (!isset($_POST['RescueDate']) || empty($_POST['RescueDate'])) {
            $errors[] = 'Rescue date is required.';
        }

        if (empty($errors)) {
            $data = [
                'Name' => $_POST['Name'],
                'Species' => $_POST['Species'],
                'Breed' => $_POST['Breed'],
                'Age' => $_POST['Age'],
                'Gender' => $_POST['Gender'],
                'AnimalCondition' => $_POST['AnimalCondition'],
                'RescueDate' => $_POST['RescueDate'],
                'AdoptionStatus' => ($_POST['CaseType'] === 'adoption') ? 'Available' : 'UnderCare',
                'ShelterID' => ($_POST['CaseType'] === 'adoption' && isset($_POST['ShelterID'])) ? $_POST['ShelterID'] : null
            ];

            if ($this->model->addAnimal($data)) {
                echo 'Animal added successfully!';
            } else {
                echo 'Failed to add the animal.';
            }
        } else {
            foreach ($errors as $error) {
                echo $error . '<br>';
            }
        }
    }

    public function handleGetRequest()
    {
        if (isset($_GET['fetchShelters'])) {
            $shelters = $this->model->getAllShelters();

            if ($shelters) {
                echo '<select id="ShelterID" name="ShelterID">';
                foreach ($shelters as $shelter) {
                    echo '<option value="' . htmlspecialchars($shelter['ShelterID']) . '">' . htmlspecialchars($shelter['ShelterName']) . '</option>';
                }
                echo '</select>';
            } else {
                echo 'No shelters found.';
            }
        }
    }
}

// Instantiate the controller
$controller = new AnimalShelterController();

// Determine the request type and call appropriate method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handlePostRequest();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller->handleGetRequest();
}
?>
