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
            'nic' => $appointmentDetails[0]['nic'] ?? 'N/A',
            'age' => $appointmentDetails[0]['age'] ?? 'N/A',
            'gender' => $appointmentDetails[0]['gender'] ?? 'N/A',
            'lab_tests' => array_map(function($test) {
                return ['prescription' => $test['prescription']];
            }, $appointmentDetails),
            'appointment_date' => $appointmentDetails[0]['appointment_date'] ?? 'N/A',
            'doctor_id' => $appointmentDetails[0]['doctor_id'] ?? 'N/A',
            'doctor_name' => $appointmentDetails[0]['doctor_name'] ?? 'N/A'
        ]);
    }
    }
