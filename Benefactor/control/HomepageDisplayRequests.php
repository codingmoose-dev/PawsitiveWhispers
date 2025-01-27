<?php
include '../model/BenefactorModel.php';

class HomepageDisplayRequests {
    private $model;

    public function __construct() {
        $this->model = new BenefactorModel(); 
    }

    public function displayOngoingCampaigns() {
        $campaigns = $this->model->getOngoingCampaigns();
        var_dump($campaigns);  // Add this for debugging
        include '../view/BenefactorHomepage.php';
    }
    
}
?>