<?php
include '../model/BenefactorModel.php';

class HomepageDisplayRequests {
    private $model;

    public function __construct() {
        $this->model = new BenefactorModel(); 
    }

    // Method to display ongoing campaigns (if needed for other use cases)
    public function displayOngoingCampaigns() {
        return $this->model->getOngoingCampaigns();
    }

    // Method to get donation impact based on BenefactorID
    public function getDonationImpact($benefactorID) {
        return $this->model->getDonationsByBenefactor($benefactorID);
    }

    public function showAnimalsUnderCare() {
        return $this->model->getAnimalsUnderCare();
    }   
}
$homepageController = new HomepageDisplayRequests();
$campaigns = $homepageController->displayOngoingCampaigns();
$animals = $homepageController->showAnimalsUnderCare();

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['benefactor_id'])) {
    $benefactorID = $_POST['benefactor_id'];
    $donationImpactController = new HomepageDisplayRequests();
    $donations = $donationImpactController->getDonationImpact($benefactorID);
}

?>