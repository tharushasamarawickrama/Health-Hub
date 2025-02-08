<?php

class LabProcessedPrescriptions {
    use Controller;
    private $labAssistantModel;
    public function __construct() {
        $this->labAssistantModel = new LabAssistant();
    }
    public function index(){
        $completedAppointments = $this->labAssistantModel->getCompletedLabAppointments();
        
        $data = [
            'appointments' => $completedAppointments
        ];
        $this->view('labprocessedprescriptions',$data);
    }
    
    public function getAppointmentData() {
        $date = $_GET['date'] ?? date('Y-m-d');
        $data = [
            'appointment_id' => '123', // Replace with actual database query
            'nic' => 'ABC123' // Replace with actual database query
        ];
        echo json_encode($data);
    }
}
