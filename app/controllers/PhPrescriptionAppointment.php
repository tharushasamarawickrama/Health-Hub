<?php
    class PhPrescriptionAppointment {
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
            $appointmentDetails = $this->pharmacistModel->getPrescriptionDetails($appointment_id);
    
            if (!$appointmentDetails) {
                $appointmentDetails = []; // Prevent errors if no data is found
            }
    
            // Pass data to view
            $this->view('phprescriptionappointment', [
                'appointment_details' => $appointmentDetails[0] ?? [], // Use first result if available
                'medications' => $appointmentDetails // Assuming medications are in the same query
            ]);
        }
    }
    
