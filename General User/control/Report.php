<?php
include '../model/AnimalShelterModel.php';

$model = new AnimalShelterModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $data = [
        'name' => $_POST['name'],
        'species' => $_POST['species'],
        'breed' => $_POST['breed'],
        'age' => $_POST['age'],
        'gender' => $_POST['gender'],
        'animalCondition' => $_POST['animal_condition'],
        'rescueDate' => $_POST['rescue_date'],
        'adoptionStatus' => ($_POST['case_type'] === 'adoption') ? 'Available' : 'UnderCare',
        'shelterID' => ($_POST['case_type'] === 'adoption') ? $_POST['shelter'] : null
    ];

    if ($model->addAnimal($data)) {
        echo json_encode(['success' => true, 'message' => 'Animal added successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add the animal.']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fetchShelters'])) {
    // Handle shelter data fetching
    $shelters = $model->getAllShelters();
    echo json_encode($shelters); // Return as JSON
}
?>
