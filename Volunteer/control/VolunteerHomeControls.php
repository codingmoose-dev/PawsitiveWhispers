<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../model/VolunteerModel.php';

// Ensure authorization
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Volunteer') {
    header("Location: ../view/SignIn.php?error=unauthorized");
    exit();
}

class VolunteerHomeControls {
    private $model;

    public function __construct() {
        $this->model = new VolunteerModel(); 
    }

    public function displayOngoingRescueMissions() {
        return $this->model->getOngoingRescueMissions();
    }

    public function displayVolunteerByID($volunteerID) {
        return $this->model->getVolunteerByID($volunteerID);
    }

    public function getVolunteerCapabilities($userID) {
        return $this->model->getVolunteerCapabilities($userID);
    }
}

class TrainingLibraryController {
    private $model;

    public function __construct() {
        $this->model = new VolunteerModel();
    }

    public function fetchAllContent() {
        return $this->model->getTrainingAndStories();
    }
}

$volunteerController = new VolunteerHomeControls();
$trainingController = new TrainingLibraryController();

$capabilities = $volunteerController->getVolunteerCapabilities($_SESSION['user_id']);
$rescueMissions = ($capabilities && $capabilities['EmergencyRescue']) ? $volunteerController->displayOngoingRescueMissions() : [];
$canManageAdoption = ($capabilities && $capabilities['ManageAdoption']);
$contentList = $trainingController->fetchAllContent();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $missionID = intval($_POST['mission_id']);
    $newStatus = $_POST['status'];
    $userID = $_SESSION['user_id'];

    $allowedStatuses = ['In Progress', 'Completed'];
    if (!in_array($newStatus, $allowedStatuses)) {
        die("Invalid status.");
    }

    $model = new VolunteerModel();
    $success = $model->updateRescueMissionStatus($missionID, $newStatus, $userID);

    if ($success) {
        header("Location: ../view/VolunteerHomepage.php?update=success");
    } else {
        header("Location: ../view/VolunteerHomepage.php?update=fail");
    }
    exit();
}
?>
