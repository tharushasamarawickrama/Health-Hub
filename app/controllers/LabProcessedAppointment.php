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
            'labtest_pdfname' => $appointmentDetails[0]['labtest_pdfname'] ?? '',
            'labtest_report' => $appointmentDetails[0]['labtest_report'] ?? '',
            'labtest_id' => $appointmentDetails[0]['labtest_id'] ?? 'N/A',
            'appointment_date' => $appointmentDetails[0]['appointment_date'] ?? 'N/A',
            'doctor_id' => $appointmentDetails[0]['doctor_id'] ?? 'N/A',
            'doctor_name' => $appointmentDetails[0]['doctor_name'] ?? 'N/A'
        ]);

    }

    public function deleteReport() {
        $input = json_decode(file_get_contents("php://input"), true);
        $labtest_id = $input['labtest_id'] ?? null;
        $appointment_id = $input['appointment_id'] ?? null;

        if (!$labtest_id || !$appointment_id) {
            echo json_encode(['success' => false, 'message' => 'Invalid labtest or appointment ID']);
            return;
        }

        // 1. Get report path from DB using both IDs
        $report = $this->labAssistantModel->getLabTestReport($appointment_id, $labtest_id);

        if (!$report || empty($report['labtest_report'])) {
            echo json_encode(['success' => false, 'message' => 'No report file to delete']);
            return;
        }

        $filePath = '../public/assets/' . $report['labtest_report'];

        // 2. Delete file if it exists
        $fileDeleted = false;
        if (file_exists($filePath)) {
            $fileDeleted = unlink($filePath);
        }

        // 3. Clear DB fields only if the file was deleted or didn't exist
        if ($fileDeleted || !file_exists($filePath)) {
            $result = $this->labAssistantModel->removeLabTestReportPath($appointment_id, $labtest_id);

            echo json_encode([
                'success' => $result,
                'message' => $result ? 'Failed to delete report in database' : 'Report deleted successfully'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to delete report file'
            ]);
        }
        exit;
    }

    public function markAsPending() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $appointment_id = $_POST['appointment_id'] ?? null;

            if (!$appointment_id) {
                die("Error: No appointment ID provided.");
            }

            // Change status from Completed to Pending
            $this->labAssistantModel->updateAppointmentStatus($appointment_id, 'Pending');

            // Redirect to the labpendingappointment controller with the appointment ID
            header("Location: " . URLROOT . "/labpendingappointment/index?appointment_id=" . $appointment_id);
            exit();
        }
    }
}