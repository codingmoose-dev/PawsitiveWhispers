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
                echo "<script>document.getElementById('message').innerHTML = 'Registration successful!';</script>";
                header("Refresh: 3; Location: /PawsitiveWellbeing/Benefactor/view/BenefactorHomepage.php"); // Redirect after 3 seconds
                exit();
            }
            else {
                echo "<script>document.getElementById('message').innerHTML = 'There was an error registering. Please try again.';</script>";
            }
        } else {
            include '../view/BenefactorRegistration.php';
        }
    }
    
}

// Initialize the Controller class
$benefactorController = new BenefactorController();

// Call the register method
$benefactorController->register();

?>
