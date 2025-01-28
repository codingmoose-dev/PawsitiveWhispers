<?php
include '../model/BenefactorModel.php';

class HomepageDisplayRequests {
    private $model;

    public function __construct() {
        $this->model = new BenefactorModel(); 
    }

    // Method to display ongoing campaigns (if needed for other use cases)
    public function displayOngoingCampaigns() {
        $campaigns = $this->model->getOngoingCampaigns();
        var_dump($campaigns);  // Add this for debugging (if necessary)
        include '../view/BenefactorHomepage.php';
    }

    // Method to get donation impact based on BenefactorID
    public function getDonationImpact($benefactorID) {
        return $this->model->getDonationsByBenefactor($benefactorID);
    }
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['benefactor_id'])) {
    $benefactorID = $_POST['benefactor_id'];
    $donationImpactController = new HomepageDisplayRequests();
    $donations = $donationImpactController->getDonationImpact($benefactorID);
    include '../view/DonationImpact.php';  
}
?>