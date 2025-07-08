<?php
session_start();
require_once '../model/BenefactorModel.php';

class BenefactorController {
    private $benefactorModel;

    public function __construct() {
        $this->benefactorModel = new BenefactorModel();
    }

    /*
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_benefactor'])) {
            $fullName = $_POST['fname'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $password = $_POST['pwd'] ?? '';
            $address = $_POST['address'] ?? '';
            $organizationType = $_POST['otype'] ?? '';
            $donationType = $_POST['donationtype'] ?? '';
            $preferredCampaign = $_POST['campaign'] ?? '';
            $availability = $_POST['availability'] ?? '';
            $paymentMethod = $_POST['payment-method'] ?? '';
            $savePayment = isset($_POST['save-payment']) ? 1 : 0;
            $sponsorEvents = isset($_POST['sponsor-events']) ? 1 : 0;
            $ngoPartnership = isset($_POST['ngo-partnership']) ? 1 : 0;
            $additionalNotes = $_POST['notes'] ?? '';

            // Basic password validation
            if (
                strlen($password) < 8 ||
                !preg_match('/[A-Z]/', $password) ||
                !preg_match('/[a-z]/', $password) ||
                !preg_match('/[0-9]/', $password) ||
                !preg_match('/[\W]/', $password)
            ) {
                $_SESSION['error'] = "Password must include uppercase, lowercase, number, special character, and be at least 8 characters.";
                header('Location: ../view/BenefactorRegistration.php');
                exit();
            }
            // Check for duplicate email
            if ($this->benefactorModel->isEmailExists($email)) {
                $_SESSION['error'] = "Email already exists.";
                header('Location: ../view/BenefactorRegistration.php');
                exit();
            }

            // Register the benefactor
            $success = $this->benefactorModel->registerBenefactor(
                $fullName, $email, $phone, $password, $address,
                $organizationType, $donationType, $preferredCampaign,
                $availability, $paymentMethod, $savePayment,
                $sponsorEvents, $ngoPartnership, $additionalNotes
            );

            if ($success) {
                $_SESSION['registration_success'] = true;
                header('Location: ../view/BenefactorHomepage.php');
                exit();
            } else {
                $_SESSION['error'] = "Registration failed.";
                header('Location: ../view/BenefactorRegistration.php');
                exit();
            }
        }
    }*/

    public function donate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['donate'])) {
            $campaignId = $_POST['campaign-id'] ?? null;
            $donationAmount = $_POST['campaign-amount'] ?? null;

            if (!is_numeric($campaignId) || !is_numeric($donationAmount)) {
                echo "failure";
                return;
            }

            $currentAmount = $this->benefactorModel->getCurrentRaisedAmount($campaignId);
            if ($currentAmount !== null) {
                $newRaisedAmount = $currentAmount + $donationAmount;
                if ($this->benefactorModel->updateRaisedAmount($campaignId, $newRaisedAmount)) {
                    echo "success";
                    return;
                }
            }
            echo "failure";
        }
    }
}

// Execute controller
$controller = new BenefactorController();
/*
// Decide the flow
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register_benefactor'])) {
        $controller->register();
    } elseif (isset($_POST['donate'])) {
        $controller->donate();
    }
}*/