<?php

class DrViewAppointments
{
    use Controller;

    public function index()
    {
        $doctorId = $_SESSION['user']['user_id'];
        $doctorType = $_SESSION['doctor_type'];

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
                        'appointment_No' => $appointment['appointment_No'],
                        'appointment_time' => $appointment['appointment_time'],
                        'name' => $patientDetails['title'] . '. ' . $patientDetails['firstName'] . ' ' . $patientDetails['lastName'],
                        'date' => $appointment['appointment_date'],
                        'status' => $appointment['status'],
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

        $schedules = [];
        if($doctorType == 'specialist'){
            $ScheduleTimeModel = new ScheduleTime();
            $schedules = $ScheduleTimeModel->getSchedule($doctorId, $today);
            array_multisort(array_column($schedules, 'start_time'), SORT_ASC, $schedules);
        }
        // var_dump($schedules);
        // exit();

        // Send data to view
        $this->view('drViewAppointments', [
            'allAppointments' => $allAppointments,
            'todaysAppointments' => $todaysAppointments,
            'upcomingAppointments' => $upcomingAppointments,
            'pastAppointments' => $pastAppointments,
            'doctorType' => $doctorType,
            'schedules' => $schedules,
        ]);
    }

    public function markCompleted()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $appointmentId = $_POST['appointmentId'] ?? null;

        if ($appointmentId) {
            $appointmentModel = new Appointment();

            $success = $appointmentModel->updateCompleteStatus($appointmentId);

            if ($success) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Could not update status']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Appointment ID missing']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    }
}

}
