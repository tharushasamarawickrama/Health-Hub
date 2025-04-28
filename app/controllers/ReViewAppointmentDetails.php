<?php

class ReViewAppointmentDetails  {
    use Controller;
    private $ReceptionistModel;

    public function __construct() {
        $this->ReceptionistModel = new Receptionist();
    }

    public function index() {
        if (!isset($_GET['appointment_id'])) {
            die("Error: No appointment ID provided.");
        }
        $appointment_id = $_GET['appointment_id'];
        $appointmentDetails = $this->ReceptionistModel->getappointmentsbyreceptionist();

        if (!$appointmentDetails) {
            die("Error: No appointment details found for the given ID.");
        }
        $this->view('reviewappointmentdetails', [
        'appointment_id' => $appointmentDetails[0]['appointment_id'] ?? 'N/A',
        'patient_name' => $appointmentDetails[0]['patient_name'] ?? 'N/A',
        'nic' => $appointmentDetails[0]['nic'] ?? 'N/A',
        'age' => $appointmentDetails[0]['age'] ?? 'N/A',
        'gender' => $appointmentDetails[0]['gender'] ?? 'N/A',
        'phoneNumber' => $appointmentDetails[0]['phoneNumber'] ?? 'N/A',
        'email' => $appointmentDetails[0]['email'] ?? 'N/A',

        'created_date' => $appointmentDetails[0]['created_date'] ?? 'N/A',
        'doctor_id' => $appointmentDetails[0]['doctor_id'] ?? 'N/A',
        'doctor_name' => $appointmentDetails[0]['doctor_name'] ?? 'N/A'
    ]);
}
}