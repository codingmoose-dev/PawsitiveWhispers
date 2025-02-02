<?php
include '../model/VolunteerModel.php';

class VolunteerHomeControls {
    private $model;

    public function __construct() {
        $this->model = new VolunteerModel(); 
    }

    public function displayOngoingRescueMissions() {
        return $this->model->getOngoingRescueMissions();
    }
}

$volunteerController = new VolunteerHomeControls();
$rescueMissions = $volunteerController->displayOngoingRescueMissions();