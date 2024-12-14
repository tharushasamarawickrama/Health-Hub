<?php

class DrViewAppointments
{
    use Controller;

    public function index()
    {
        // Hardcoded doctor ID
        $doctorId = 8;

        // Initialize models
        $appointmentModel = new Appointment();
        $userModel = new User();

        // Fetch all appointments for the doctor
        $appointments = $appointmentModel->getAppointmentsByDoctorId($doctorId);

        // Prepare filtered appointment lists
        $allAppointments = [];
        $todaysAppointments = [];
        $upcomingAppointments = [];
        $pastAppointments = [];

        $today = (new DateTime())->format('Y-m-d');

        if (is_array($appointments) && !empty($appointments)) {
            foreach ($appointments as $appointment) {
                $patientDetails = $userModel->getUserById($appointment['patient_id']);
                if ($patientDetails) {
                    $formattedAppointment = [
                        'id' => $appointment['appointment_id'],
                        'name' => $patientDetails['title'] . '. ' . $patientDetails['firstName'] . ' ' . $patientDetails['lastName'],
                        'date' => $appointment['appointment_date']
                    ];

                    // Add to all appointments
                    $allAppointments[] = $formattedAppointment;

                    // Categorize based on date
                    if ($appointment['appointment_date'] === $today) {
                        $todaysAppointments[] = $formattedAppointment;
                    } elseif ($appointment['appointment_date'] > $today) {
                        $upcomingAppointments[] = $formattedAppointment;
                    } else {
                        $pastAppointments[] = $formattedAppointment;
                    }
                }
            }
        }

        // Send data to view
        $this->view('drViewAppointments', [
            'allAppointments' => $allAppointments,
            'todaysAppointments' => $todaysAppointments,
            'upcomingAppointments' => $upcomingAppointments,
            'pastAppointments' => $pastAppointments
        ]);
    }
}
