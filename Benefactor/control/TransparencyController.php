<?php
session_start();
require_once '../model/BenefactorModel.php';

class TransparencyController {
    
    public function showTransparencyPage() {
        // This page is public, so no authentication check is needed.
        $model = new BenefactorModel();
        
        $summary = $model->getFinancialSummary();
        $fundLog = $model->getFundUsageLog();
        $campaigns = $model->getCampaignFinancials();

        $activePage = 'transparency';
        require_once '../view/Transparency.php';
    }
}

$controller = new TransparencyController();
$controller->showTransparencyPage();