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
            $schedules = new ScheduleTime;

            foreach ($appointmentdata as $appointment_item) {
                $arr['doctor_id'] = $appointment_item['doctor_id'];
                $doctorData = $doctor->first($arr);
                $arr3['schedule_id'] = $appointment_item['schedule_id'];
                $schedulesData = $schedules->first($arr3);

                if ($doctorData) {
                    $user = new User;
                    $arr2['user_id'] = $doctorData['doctor_id'];
                    $userData = $user->first($arr2);

                    if ($userData) {
                        // Combine the data into one array
                        $combinedData = [
                            'appointment' => $appointment_item,
                            'doctor' => $doctorData,
                            'user' => $userData,
                            'schedules' => $schedulesData,
                        ];

                        // Add the combined data to the main array
                        $data[] = $combinedData;
                    }
                }
            }

            // Handle form submission for appointment deletion
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm-ok'])) {
                $appointmentId = $_POST['appointment_id'];
                $appointment = new Appointment;
                $arr['appointment_id'] = $appointmentId;
                $appointmentData = $appointment->first($arr);

                if ($appointmentData) { // Check if appointment data exists
                    $schedule = new ScheduleTime;
                    $arr5['schedule_id'] = $appointmentData['schedule_id'];
                    $scheduleData = $schedule->first($arr5);
                    
                    if ($scheduleData) { // Check if schedule data exists
                        $arr6['filled_slots'] = $scheduleData['filled_slots'] - 1;
                        
                        $schedule->update($arr5['schedule_id'], $arr6, 'schedule_id'); // Update the filled slots in the schedule
                    }

                    $appointment->update($appointmentId, ['isdeleted' => 1], 'appointment_id'); // Soft delete the appointment
                }

                // Redirect to refresh the page
                redirect('pendingappointment');
            }
        }

        $this->view('pendingappointment', ['appointments' => $data]);
    }
}
