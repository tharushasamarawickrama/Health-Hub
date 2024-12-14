<?php

class DrDashboard
{
    use Controller;

    public function index()
    {
        // Hardcoded doctor ID
        $doctorId = 8;

        // Initialize models
        $appointmentModel = new Appointment();
        $userModel = new User();

        // Fetch appointments for the doctor
        $appointments = $appointmentModel->getTodaysAppointments($doctorId);
        //var_dump($appointments);
        
        // Check if $appointments is valid
        $appointmentsToday = [];
        if (is_array($appointments) && !empty($appointments)) {
            // Fetch patient details for the appointments
            foreach ($appointments as $appointment) {
                $patientDetails = $userModel->getUserById($appointment['patient_id']);
                if ($patientDetails) {
                    $appointmentsToday[] = [
                        'id' => '#' . str_pad($appointment['appointment_id'], 4, '0', STR_PAD_LEFT),
                        'name' => $patientDetails['title'] . ' ' . $patientDetails['firstName'] . ' ' . $patientDetails['lastName']
                    ];
                }
            }
        }

        // Load the view and pass the data
        $this->view('drDashboard', ['appointmentsToday' => $appointmentsToday]);
    }
}
