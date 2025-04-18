<?php

class LabProcessedPrescriptions {
    use Controller;
    private $labAssistantModel;

    public function __construct() {
        $this->labAssistantModel = new LabAssistant();
    }

    public function index($appointment_id = null) {
        $completedAppointments = $this->labAssistantModel->getCompletedLabAppointments($appointment_id);
        
        $data = [
            'appointments' => $completedAppointments
        ];
        $this->view('labprocessedprescriptions',$data);
    }
    
    public function getAppointmentsByDate() {
        $date = $_GET['date'] ?? date('Y-m-d');
        $appointments = $this->labAssistantModel->getAppointmentsByDate($date);
        echo json_encode($appointments);
    }
}
