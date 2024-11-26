<?php
class LabPrescriptions {
    use Controller;
    private $labAssistantModel;

    public function __construct() {
        $this->labAssistantModel = new LabAssistant();
    }

    public function index() {
        $appointments = $this->labAssistantModel->getLabAppointments();
        
        $data = [
            'appointments' => $appointments
        ];
        
        $this->view('labprescriptions', $data);
    }
}

