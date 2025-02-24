<?php
class LabPrescriptionAppointment {
    use Controller;
    private $labAssistantModel;

    public function __construct() {
        $this->labAssistantModel = new LabAssistant();
    }

    public function index() {
        if (!isset($_GET['appointment_id'])) {
            die("Error: No appointment ID provided.");
        }

        $appointment_id = $_GET['appointment_id'];
        $appointmentDetails = $this->labAssistantModel->getAppointmentDetails($appointment_id);

        if (!$appointmentDetails) {
            $appointmentDetails = []; // Prevent errors if no data is found
        }

        // Pass data to view
        $this->view('labprescriptionappointment', [
            'appointment_details' => $appointmentDetails[0] ?? []// Use first result if available// Assuming medications are in the same query
        ]);
    }
    }
