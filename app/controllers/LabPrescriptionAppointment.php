<?php

class Labprescriptionappointment {
    use Controller;
    private $labAssistantModel;

    public function __construct() {
        $this->labAssistantModel = new LabAssistant();
    }

    public function index($appointment_id)
{
    $labAssistant = new LabAssistant();
    $prescription = $labAssistant->getLabPrescriptionDetails($appointment_id);
    
    $data = [
        'prescription' => $prescription[0]
    ];
    
    $this->view('labprescriptionappointment', $data);
}

    
}