<?php

class PendingAppointment
{
    use Controller;

    public function index()
    {
        $appointment = new Appointment;
        $data = []; // Initialize an empty array to hold the combined data
        $user_id = $_SESSION['user']['user_id'];
        $appointmentdata = $appointment->getAppointmentsByUserId($user_id);

        if ($appointmentdata) {
            $doctor = new Doctor;

            foreach ($appointmentdata as $appointment_item) {
                $arr['doctor_id'] = $appointment_item['doctor_id'];
                $doctorData = $doctor->first($arr);

                if ($doctorData) {
                    $user = new User;
                    $arr2['user_id'] = $doctorData['doctor_id'];
                    $userData = $user->first($arr2);

                    if ($userData) {
                        // Combine the data into one array
                        $combinedData = [
                            'appointment' => $appointment_item,
                            'doctor' => $doctorData,
                            'user' => $userData
                        ];

                        // Add the combined data to the main array
                        $data[] = $combinedData;
                    }
                }
            }

            // Handle form submission for appointment deletion
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm-ok'])) {
                $appointmentId = $_POST['appointment_id'];
                $appointment->delete($appointmentId, 'appointment_id');
                redirect('pendingappointment'); // Redirect to refresh the page
            }
        }

        $this->view('pendingappointment', ['appointments' => $data]);
    }
}
