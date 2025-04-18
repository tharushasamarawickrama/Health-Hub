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
            'appointment_id' => $appointment_id,
            'nic' => $appointmentDetails[0]['nic'] ?? 'N/A' ,
            'age' => $appointmentDetails[0]['age'] ?? 'N/A',
            'gender' => $appointmentDetails[0]['gender'] ?? 'N/A',
            'appointment_date' => $appointmentDetails[0]['appointment_date'] ?? 'N/A',
            'doctor_id' => $appointmentDetails[0]['doctor_id'] ?? 'N/A',
            'doctor_name' => $appointmentDetails[0]['doctor_name'] ?? 'N/A',
            'labtests' => $appointmentDetails // Pass all test details
        ]);
    }

    public function uploadReport() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $appointment_id = $_POST['appointment_id'];
            $labtest_id = $_POST['labtest_id'] ?? null;
            // Validate file type and size
            if(isset($_FILES['reportFile']) && $_FILES['reportFile']['error'] == UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['reportFile']['tmp_name'];
                $fileName = $_FILES['reportFile']['name'];
                $fileSize = $_FILES['reportFile']['size'];
                $fileType = $_FILES['reportFile']['type'];

                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if($fileExtension != 'pdf') {
                    die("Only PDF files are allowed");
                }
                $newFileName = uniqid('report_',true) . '.pdf';
                $uploadDir = APPROOT . '/../public/assets/lab-reports/';
                $dest_path = $uploadDir . $newFileName;

                if(move_uploaded_file($fileTmpPath, $dest_path)) {
                    $relativepath = 'assets/lab-reports/' . $newFileName;

                    $this->labAssistantModel->uploadReport($appointment_id, $labtest_id, $relativepath,$fileName);
                    redirect('labprescriptionappointment?appointment_id=' . $appointment_id);
                } else {
                    die("Error uploading file");
                }
            } else {
                die("No file uploaded or error in file upload");
            }
        }
    }

    public function markPending() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $appointment_id = $_POST['appointment_id'];
            $this->labAssistantModel->updateAppointmentStatus($appointment_id, 'Pending');
            redirect('labprescriptionappointment?appointment_id=' . $appointment_id);    
        }
    }

    public function markCompleted() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $appointment_id = $_POST['appointment_id'];
            $this->labAssistantModel->updateAppointmentStatus($appointment_id, 'Completed');

            redirect('labdashboard');
        }
    }
    
}