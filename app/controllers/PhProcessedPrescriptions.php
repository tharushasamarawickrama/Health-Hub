<?php

class PhProcessedPrescriptions {
    use Controller;
    private $pharmacistModel;

    public function __construct() {
        $this->pharmacistModel = new Pharmacist();
    }
    public function index($appointment_id = null){
        $completedAppointments = $this->pharmacistModel->getCompletedPhAppointments($appointment_id);
        $data = [
            'appointments' => $completedAppointments
        ];
        $this->view('phprocessedprescriptions',$data);
    }


    public function getAppointmentsByDate() {
        $date = $_GET['date'] ?? date('Y-m-d');
        $appointments = $this->pharmacistModel->getAppointmentsByDate($date);
            echo json_encode($appointments);
    }
}