<?php
include '../model/BenefactorModel.php';

class HomepageDisplayRequests {
    private $model;

    public function __construct() {
        $this->model = new BenefactorModel();  // Instantiate the model
    }

    // Method to fetch all the ongoing campaigns
    public function displayOngoingCampaigns() {
        $campaigns = $this->model->getOngoingCampaigns();
        include '../view/BenefactorHomepage.php';  // Include the view to display data
    }


}
?>