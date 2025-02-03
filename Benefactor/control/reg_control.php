<?php
session_start();

// Include the BenefactorModel
require_once '../model/BenefactorModel.php';

class BenefactorController {

    private $benefactorModel;

    public function __construct() {
        $this->benefactorModel = new BenefactorModel();  // Initialize the BenefactorModel
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Collecting form data
            $fullName = $_POST['fname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['pwd'];
            $address = $_POST['address'];
            $organizationType = $_POST['otype'];
            $donationType = $_POST['donationtype'];
            $preferredCampaign = $_POST['campaign'];
            $availability = $_POST['availability'];
            $paymentMethod = $_POST['payment-method'];
            $savePayment = $_POST['save-payment'];
            $sponsorEvents = $_POST['sponsor-events'];
            $ngoPartnership = $_POST['ngo-partnership'];
            $additionalNotes = $_POST['notes'];

            if ($this->benefactorModel->isEmailExists($email)) {
                echo "<script>document.getElementById('message').innerHTML = 'Email already exists. Please try a different email.';</script>";
                return;
            }
    
            $result = $this->benefactorModel->registerBenefactor($fullName, $email, $phone, $password, $address, $organizationType, $donationType, $preferredCampaign, $availability, $paymentMethod, $savePayment, $sponsorEvents, $ngoPartnership, $additionalNotes);
    
            if ($result) {
                $_SESSION['registration_success'] = true;
                header('Location: ../view/BenefactorHomepage.php');
                exit();
            } else {
                return "Registration failed. Please try again.";
            }
        } else {
            include '../view/BenefactorRegistration.php';
        }
    }

    public function donate($campaignId, $donationAmount) {
        // Check if both campaign ID and donation amount are valid
        if (!empty($campaignId) && !empty($donationAmount)) {
            // Get the current raised amount for the campaign using the model
            $currentAmount = $this->benefactorModel->getCurrentRaisedAmount($campaignId);

            if ($currentAmount !== null) {
                // Calculate the new raised amount
                $newRaisedAmount = $currentAmount + $donationAmount;

                // Update the raised amount in the database using the model
                if ($this->benefactorModel->updateRaisedAmount($campaignId, $newRaisedAmount)) {
                    return "success";  // Donation successful
                } else {
                    return "failure";  // Database update failed
                }
            } else {
                return "failure";  // Campaign not found
            }
        } else {
            return "failure";  // Invalid input
        }
    }
}

// Initialize the Controller class
$benefactorController = new BenefactorController();

// Call the register method
$benefactorController->register();

// Handle the donation request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get campaign ID and donation amount from the POST request
    $campaignId = $_POST['campaign-id'];
    $donationAmount = $_POST['campaign-amount'];
    $result = $benefactorController->donate($campaignId, $donationAmount);

    echo $result;  // Output success or failure
}
?>

