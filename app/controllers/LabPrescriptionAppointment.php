<?php

class LabPrescriptionAppointment {
    use Controller;

    private $labAssistantModel;

    public function __construct() {
        $this->labAssistantModel = new LabAssistant();
    }

    public function index() {
        $appointment_id = 2; // Hardcoded for now

        if (empty($appointment_id) || !is_numeric($appointment_id)) {
            redirect('labprescriptions'); // Redirect if ID is invalid
            return;
        }

        // Fetch prescription details for the given appointment ID
        $prescriptionDetails = $this->labAssistantModel->getLabPrescriptionDetails($appointment_id);

        if (empty($prescriptionDetails)) {
            redirect('labprescriptions'); // Redirect if no details found
            return;
        }

        // Pass data to the view
        $data = $prescriptionDetails; // Get the first record (expected one result)
        $this->view('labprescriptionappointment', $data);
    }
    
}
