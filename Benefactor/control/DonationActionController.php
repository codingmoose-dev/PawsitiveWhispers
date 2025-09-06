<?php
session_start();
require_once '../model/BenefactorModel.php';

class DonationActionController {
    private $model;

    public function __construct() {
        $this->model = new BenefactorModel();
    }

    public function processDonation() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectWithMessage('Invalid request method.', 'error');
        }
        
        if (!isset($_POST['amount']) || !is_numeric($_POST['amount']) || $_POST['amount'] <= 0) {
            $this->redirectWithMessage('Invalid donation amount.', 'error');
        }
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: ../view/SignIn.php?error=unauthorized");
            exit();
        }

        $donorID = $_SESSION['user_id'];
        $amount = $_POST['amount'];
        $campaignID = $_POST['campaign_id'] ?? null;
        $animalID = $_POST['animal_id'] ?? null;
        $purpose = $_POST['purpose'] ?? null; 
        
        $success = $this->model->recordDonation($donorID, $amount, $campaignID, $animalID, $purpose);
        if ($success) {
            $this->redirectWithMessage('Thank you for your generous donation!', 'success');
        } else {
            $this->redirectWithMessage('Sorry, there was an issue processing your donation.', 'error');
        }
    }

    // Placeholder for future "Donation Impact" feature.
    public function showDonationImpact() {
        $totalDonated = $this->model->getTotalDonationsByUser($_SESSION['user_id']);
        $message = "You have donated a total of $" . number_format($totalDonated, 2) . ". Thank you for making a difference!";
        $this->redirectWithMessage($message, 'success');
    }
    
    
    // A helper function to handle redirects and session messages.
    private function redirectWithMessage($message, $type) {
        if ($type === 'success') {
            $_SESSION['donation_success'] = $message;
        } else {
            $_SESSION['donation_error'] = $message;
        }
        header("Location: ../view/Donate.php");
        exit();
    }
}

$action = $_REQUEST['action'] ?? '';
$controller = new DonationActionController();

switch ($action) {
    case 'processDonation':
        $controller->processDonation();
        break;
    
    case 'showImpact':
        $controller->showDonationImpact();
        break;

    default:
        header("Location: ../view/Donate.php");
        exit();
}