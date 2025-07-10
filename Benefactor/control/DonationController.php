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
            $campaignId = $_POST['campaign_id'] ?? null;
            $donationAmount = $_POST['amount'] ?? null;

            if (!is_numeric($campaignId) || !is_numeric($donationAmount) || $donationAmount <= 0) {
                $_SESSION['donation_error'] = "Invalid input.";
                header("Location: ../view/Donate.php");
                exit();
            }

            $currentAmount = $this->benefactorModel->getCurrentRaisedAmount($campaignId);
            if ($currentAmount !== null) {
                $newRaisedAmount = $currentAmount + $donationAmount;

                // Update the campaign's raised amount
                $updateSuccess = $this->benefactorModel->updateRaisedAmount($campaignId, $newRaisedAmount);

                // Insert into the Donations table
                $recordSuccess = $this->benefactorModel->recordCampaignDonation(
                    $campaignId,
                    $_SESSION['user_id'],
                    $donationAmount
                );

                if ($updateSuccess && $recordSuccess) {
                    $_SESSION['donation_success'] = "Thank you for your kind donation!";
                    header("Location: ../view/Donate.php");
                    exit();
                }
            }

            $_SESSION['donation_error'] = "Something went wrong while processing your donation.";
            header("Location: ../view/Donate.php");
            exit();
        }
    }

}

// Execute controller
$controller = new BenefactorController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['donate'])) {
    $controller->donate();
}