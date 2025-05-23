<?php

class DrAppointment
{
    use Controller;

    public function index()
    {
        if (!isset($_GET['appointment_id'])) {
            redirect('drViewAppointments');
        }

        $lastAppointmentId = null;
        if (isset($_GET['last_appointment'])) {
            $lastAppointmentId = $_GET['last_appointment'];
        }
        
        $appointmentId = $_GET['appointment_id'];

        // Initialize models
        $appointmentModel = new Appointment();
        //$userModel = new User();

        // Fetch the appointment details by ID
        $appointment = $appointmentModel->getAppointmentById($appointmentId);

        if (!$appointment) {
            redirect('drViewAppointments');
        }

        if (!$appointment) {
            redirect('drViewAppointments');
        }

        // Prepare the data for the view
        $data = [
            'id' => $appointmentId,
            'appointment_No' => $appointment['appointment_No'],
            'appointment_date' => $appointment['appointment_date'],
            'patient_name' => $appointment['title'] . '. ' . $appointment['p_firstName'] . ' ' . $appointment['p_lastName'],
            'age' => $appointment['age'],
            'gender' => $appointment['gender'],
            'phone' => $appointment['phoneNumber'],
            'email' => $appointment['email'],
            'medical_history' => 'Asthma, Mild Allergies, Previous Surgery for Appendicitis (2023)',
            'full_medical_history_link' => '#',
            'last_appointment_id' => $lastAppointmentId,
        ];

        // Load the view
        $this->view('drAppointment', $data);
    }
}
