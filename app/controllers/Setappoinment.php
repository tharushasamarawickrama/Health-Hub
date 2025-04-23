<?php

class Setappoinment
{
    use Controller;

    public function index()
    {
        $id = $_GET['id'] ?? null;
        $sch_id = $_GET['sch_id'] ?? null;

        $appoinment = new Appointment;
        $referal = $appoinment->getDistinctReferalAndUserDetails($_SESSION['user']['user_id']);
        $referal = array_filter($referal, function ($item) {
            return $item['referal_id'] != 0;
        });

        // Re-index the array to maintain sequential keys
        $referal = array_values($referal);
        // show($referal);
        // Handle form submission for appointment
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // If the form is being submitted for appointment creation
            if (isset($_POST['p_firstName'])) {

                $schedule = new ScheduleTime;

                $data = [
                    'p_firstName' => $_POST['p_firstName'],
                    'p_lastName' => $_POST['p_lastName'],
                    'nic' => $_POST['nic'],
                    'phoneNumber' => $_POST['phoneNumber'],
                    'age' => $_POST['age'],
                    'address' => $_POST['address'],
                    'email' => $_POST['email'],
                    'gender' => $_POST['gender'],
                    'title' => $_POST['Title'],
                    'add_service' => $_POST['addservice'],
                    'doctor_id' => $id,
                    'patient_id' => $_SESSION['user']['user_id'],
                    'payment_status' => 'pending',
                    'referal_id' => $_POST['patientType'],
                    'isdeleted' => 0,
                    'status' => 'new',

                ];

                $_SESSION['sch_id'] = $sch_id;
                $scheduleData = $schedule->first(['schedule_id' => $sch_id]);
                $data['appointment_No'] = $scheduleData['filled_slots'] + 1;
                $data['appointment_date'] = $scheduleData['date'];

                $_SESSION['appointment'] = $data;

                // Redirect to the next page
                redirect('patientchannel');
            }
        }
        show($referal);
        // Load the view without any pre-filled data
        $this->view('setappoinment', ['referal' => $referal]);
    }
}