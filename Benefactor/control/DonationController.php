<?php
session_start();
require_once '../model/BenefactorModel.php';

class BenefactorController {
    private $benefactorModel;

    public function __construct() {
        $this->benefactorModel = new BenefactorModel();
    }

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['donate'])) {
    $controller->donate();
}