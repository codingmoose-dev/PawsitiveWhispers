<?php
include '../model/user_model.php'; 

if (isset($_GET['action']) && $_GET['action'] === 'update') {
    // Get data from form
    $userId = $_POST['user_id'];
    $attribute = $_POST['attribute'];
    $newValue = $_POST['new_value'];

    // Instantiate the UserModel
    $userModel = new UserModel();

    // Update the user attribute in the database
    $userModel->updateUserAttribute($userId, $attribute, $newValue);

    // Redirect back to the view page
    header('Location: view_info.php');
    exit();
}
?>
