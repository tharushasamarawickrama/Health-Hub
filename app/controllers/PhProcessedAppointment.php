<?php

class PhProcessedAppointment {
    use Controller;
    private $pharmacistModel;
    public function __construct() {
        $this->pharmacistModel = new Pharmacist();
    }
    
    public function index() {
        if (!isset($_GET['appointment_id'])) {
            die("Error: No appointment ID provided.");
        }

        $appointment_id = $_GET['appointment_id'];
        $appointmentDetails = $this->pharmacistModel->getCompletedPhAppointments($appointment_id);

        if (!$appointmentDetails) {
            $appointmentDetails = []; // Prevent errors if no data is found
        }

        // Pass data to view
        $this->view('phprocessedappointment', [
            'appointment_id' => $appointment_id,
            'nic' => $appointmentDetails[0]['nic'] ?? 'N/A' ,
            'age' => $appointmentDetails[0]['age'] ?? 'N/A',
            'gender' => $appointmentDetails[0]['gender'] ?? 'N/A',
            'appointment_date' => $appointmentDetails[0]['appointment_date'] ?? 'N/A',
            'medications' => $appointmentDetails ,
            'doctor_id' => $appointmentDetails[0]['doctor_id'] ?? 'N/A',
            'doctor_name' => $appointmentDetails[0]['doctor_name'] ?? 'N/A',
            'units_issued' => $appointmentDetails[0]['units_issued'] ?? 'N/A',
        ]);
    }
}