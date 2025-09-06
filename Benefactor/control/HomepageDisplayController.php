<?php
include '../model/BenefactorModel.php';

class HomepageDisplayRequests {
    private $model;

    public function __construct() {
        $this->model = new BenefactorModel(); 
    }

    public function getHomepageData($benefactorID) {
        return [
            'campaigns' => $this->model->getOngoingCampaigns(),
            'animals' => $this->model->getAnimalsUnderCare(),
            'donations' => $this->model->getDonationsByBenefactor($benefactorID)
        ];
    }
}

$homepageController = new HomepageDisplayRequests();
$data = $homepageController->getHomepageData($_SESSION['user_id']);
?>
