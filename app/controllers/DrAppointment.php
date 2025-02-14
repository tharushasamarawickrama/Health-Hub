<?php

class DrAppointment
{
    use Controller;

    public function index()
    {
        if (!isset($_GET['appointment_id'])) {
            redirect('drViewAppointments');
        }
        
        $appointmentId = $_GET['appointment_id'];

        // Initialize models
        $appointmentModel = new Appointment();
        $userModel = new User();

        // Fetch the appointment details by ID
        $appointment = $appointmentModel->getPatientByAppointmentId($appointmentId);

        if (!$appointment) {
            redirect('drViewAppointments');
        }

        // Fetch the patient's details
        $patientDetails = $userModel->getUserById($appointment[0]['patient_id']);

        if (!$patientDetails) {
            redirect('drViewAppointments');
        }

        // Prepare the data for the view
        $data = [
            'id' => $appointmentId,
            'patient_name' => $patientDetails['title'] . '. ' . $patientDetails['firstName'] . ' ' . $patientDetails['lastName'],
            'age' => $patientDetails['age'],
            'gender' => $patientDetails['gender'],
            'phone' => $patientDetails['phoneNumber'],
            'email' => $patientDetails['email'],
            'medical_history' => 'Asthma, Mild Allergies, Previous Surgery for Appendicitis (2023)',
            'full_medical_history_link' => '#'
        ];

        // Load the view
        $this->view('drAppointment', $data);
    }
}
