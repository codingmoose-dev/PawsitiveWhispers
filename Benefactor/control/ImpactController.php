<?php
// File: control/ImpactController.php

session_start();
require_once '../model/BenefactorModel.php';

class ImpactController {
    
    public function showImpactPage() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Benefactor') {
            header("Location: ../view/SignIn.php?error=unauthorized");
            exit();
        }
        
        $model = new BenefactorModel();
        $donations = $model->getDonationsByBenefactor($_SESSION['user_id']);

        $activePage = 'impact';

        require_once '../view/Impact.php';
    }
}

$controller = new ImpactController();
$controller->showImpactPage();