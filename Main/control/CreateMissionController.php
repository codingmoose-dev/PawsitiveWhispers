<?php
session_start();
require_once '../model/RescueMissionModel.php';

define('UPLOAD_DIR', '../uploads/mission_reports/');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['location']) || empty($_POST['description']) || !isset($_FILES['photo'])) {
        header("Location: PawsitiveWhispers/Main/view/Homepage.html?error=missing_fields");
        exit();
    }

    $location = trim($_POST['location']);
    $description = trim($_POST['description']);
    $missionName = "New report from: " . $location;
    $reportedById = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
    $imagePath = null;
    
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo = $_FILES['photo'];
        $fileName = $photo['name'];
        $fileTmpName = $photo['tmp_name'];
        
        $uniqueFileName = uniqid('', true) . '_' . basename($fileName);
        $targetFilePath = UPLOAD_DIR . $uniqueFileName;

        if (move_uploaded_file($fileTmpName, $targetFilePath)) {
            $imagePath = 'uploads/mission_reports/' . $uniqueFileName;
        } else {
            header("Location: PawsitiveWhispers/Main/view/Homepage.html?error=upload_failed");
            exit();
        }
    } else {
        header("Location: PawsitiveWhispers/Main/view/Homepage.html?error=no_file");
        exit();
    }

    $model = new RescueMissionModel();
    $success = $model->createMission($missionName, $description, $reportedById, $location, $imagePath);

    if ($success) {
        header("Location: PawsitiveWhispers/Main/view/Homepage.html?report=success");
        exit();
    } else {
        header("Location: PawsitiveWhispers/Main/view/Homepage.html?error=db_error");
        exit();
    }
}
?>