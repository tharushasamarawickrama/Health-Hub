<?php
class LabPendingAppointment{
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
        $appointmentDetails = $this->labAssistantModel->getPendingLabAppointments($appointment_id);

        if (!$appointmentDetails) {
            die("Error: No appointment details found for the given ID.");
        }
        $this->view('labpendingappointment', [
        'appointment_id' => $appointmentDetails[0]['appointment_id'] ?? 'N/A',
        'nic' => $appointmentDetails[0]['nic'] ?? 'N/A',
        'age' => $appointmentDetails[0]['age'] ?? 'N/A',
        'gender' => $appointmentDetails[0]['gender'] ?? 'N/A',
        'labtests' => $appointmentDetails, // Pass individual lab tests
        'appointment_date' => $appointmentDetails[0]['appointment_date'] ?? 'N/A',
        'doctor_id' => $appointmentDetails[0]['doctor_id'] ?? 'N/A',
        'doctor_name' => $appointmentDetails[0]['doctor_name'] ?? 'N/A'
    ]);
}
public function uploadReport() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $appointment_id = $_POST['appointment_id'];
        $labtest_id = $_POST['labtest_id'] ?? null;

        // Validate file type and size
        if (isset($_FILES['reportFile']) && $_FILES['reportFile']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['reportFile']['tmp_name'];
            $fileName = $_FILES['reportFile']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if ($fileExtension != 'pdf') {
                die("Only PDF files are allowed");
            }

            $newFileName = uniqid('report_', true) . '.pdf';
            $uploadDir = APPROOT . '/../public/assets/lab-reports/';
            $dest_path = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $relativepath = 'assets/lab-reports/' . $newFileName;

                // Save the report path in the database
                $this->labAssistantModel->uploadReport($appointment_id, $labtest_id, $relativepath, $fileName);

                // Redirect back to the same page
                redirect('labpendingappointment?appointment_id=' . $appointment_id);
            } else {
                die("Error uploading file");
            }
        } else {
            die("No file uploaded or error in file upload");
        }
    }
}
public function markAsCompleted() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $appointment_id = $_POST['appointment_id'];

        // Update the appointment status to "Completed"
        $this->labAssistantModel->updateAppointmentStatus($appointment_id, 'Completed');

        // Redirect to the "Pending Prescriptions" page
        redirect('labpendingprescriptions');
    }
}
}