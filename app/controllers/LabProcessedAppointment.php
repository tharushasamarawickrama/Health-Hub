<?php

class LabProcessedAppointment {
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
        $appointmentDetails = $this->labAssistantModel->getCompletedLabAppointments($appointment_id);

        if (!$appointmentDetails) {
            die("Error: No appointment details found for the given ID.");
        }
        $this->view('labprocessedappointment', [
            'appointment_id' => $appointmentDetails[0]['appointment_id'] ?? 'N/A',
            'nic' => $appointmentDetails[0]['nic'] ?? 'N/A',
            'age' => $appointmentDetails[0]['age'] ?? 'N/A',
            'gender' => $appointmentDetails[0]['gender'] ?? 'N/A',
            'labtest_name' => $appointmentDetails[0]['labtest_name'] ?? '', // Pass labtest_name
            'appointment_date' => $appointmentDetails[0]['appointment_date'] ?? 'N/A',
            'doctor_id' => $appointmentDetails[0]['doctor_id'] ?? 'N/A',
            'doctor_name' => $appointmentDetails[0]['doctor_name'] ?? 'N/A'
        ]);

}

public function deleteReport($labtest_id) {
    if (!$labtest_id) {
        echo json_encode(['success' => false, 'message' => 'Invalid labtest ID']);
        return;
    }

    $result = $this->labAssistantModel->deleteLabTestReport($labtest_id);
    
    header('Content-Type: application/json');
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Report deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete report']);
    }
    exit;
}
}