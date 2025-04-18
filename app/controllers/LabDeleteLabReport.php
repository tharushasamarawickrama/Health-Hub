<?php

class LabDeleteLabReport {
    use Controller; // Assuming this includes shared functionality like model loading
    private $labAssistantModel;
    

    public function __construct() {
        $this->labAssistantModel = new LabAssistant();
    }

    public function index($labtest_id = null) {
        $labtest_id = 3;
        // Call the deleteReport method and handle the response
        $this->deleteReport($labtest_id);
    }

    public function deleteReport($labtest_id) {
        // Validate labtest_id
        if (!$labtest_id) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid labtest ID']);
            exit;
        }

        // Use the model to delete the lab test report
        $result = $this->labAssistantModel->deleteLabTestReport($labtest_id);

        // Send JSON response
        header('Content-Type: application/json');
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Report deleted successfully']);
            redirect("labprocessedappointment");
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete report']);
        }
        exit;
    }
}
