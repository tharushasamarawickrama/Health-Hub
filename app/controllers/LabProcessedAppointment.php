<?php

class LabProcessedAppointment {
    use Controller;
    private $labAssistantModel;

    public function __construct() {
        $this->labAssistantModel = new LabAssistant();
    }

   
    public function index() {
    $appointment_id = 455; // Hardcoded for now

    if (empty($appointment_id) || !is_numeric($appointment_id)) {
        redirect('labprocessedprescriptions'); // Redirect if ID is invalid
        return;
    }

    // Fetch prescription details for the given appointment ID
    $prescriptionDetails = $this->labAssistantModel->getAppointmentDetails($appointment_id);

    if (empty($prescriptionDetails)) {
        redirect('labprocessedprescriptions'); // Redirect if no details found
        return;
    }

    // Pass data to the view
    $data = $prescriptionDetails; 
    $data['reports'] = $prescriptionDetails; // Initialize empty array or fetch actual reports
// Get the first record (expected one result)
    $this->view('labprocessedappointment', $data);
}
     
    public function deleteReport($labtest_id) {
        error_log("deleteReport called with ID: $labtest_id");
        $labAssistant = new LabAssistant();
        if ($labAssistant->deleteLabTestReport($labtest_id)) {
            echo "Report deleted successfully";
        } else {
            echo "Error deleting report";
        }
    }
}