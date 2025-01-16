<?php
// Include the controller
require_once __DIR__ . '/../control/UserController.php';

// Initialize the controller and handle the request
$userController = new UserController();
$userController->handleRequest();
?>
