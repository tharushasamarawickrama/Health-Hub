<?php

class RePatientChannel {
    use Controller;

    public function index() {
        
        // Initialize models
        $appointment = new Appointment;
        $doctor = new Doctor;
        $user = new User;
        $schedule = new ScheduleTime;

        // Get user and doctor IDs from session
        $userId = $_SESSION['user']['user_id'];
        $doctorId = $_SESSION['appointment']['doctor_id'];

        // Fetch doctor and user details
        $arr['doctor_id'] = $doctorId;
        $arr1['user_id'] = $doctorId; // Assuming this is correct based on your logic
        $data = $doctor->first($arr);
        $data1 = $user->first($arr1);

        if ($data1) {
            $data = array_merge($data, $data1);
        }

        // Fetch schedule details
        $arr['schedule_id'] = $_SESSION['sch_id'];
        $scheduleData = $schedule->first($arr);

        if ($scheduleData) {
            $data = array_merge($data, $scheduleData);
        }

        // Get the count of same-month appointments
        $sameMonthAppointmentCount = $appointment->getSameMonthAndReferalAppointmentCount(
            $userId, 
            $_SESSION['appointment']['referal_id'], 
            date('m'), 
            date('Y')
        );   
        show($sameMonthAppointmentCount); 
        $_SESSION['appointment']['sameMonthAppointmentCount'] = $sameMonthAppointmentCount;

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmbtn'])) {
            // Update filled slots in the schedule
            $data['filled_slots'] = $data['filled_slots'] + 1;
            $schedule->update($data['schedule_id'], $data, 'schedule_id');
            
            // Set the appointment date from the form submission
            if (isset($_POST['appointment_date'])) {
                $_SESSION['appointment']['appointment_date'] = $_POST['appointment_date'];
            } else {
                die('Appointment date is missing.');
            }

            // Handle referral logic
            if ($_SESSION['appointment']['referal_id'] == 'new') {
                $referal = new Patient_Referal;
                $arr2 = [
                    'user_id' => $_SESSION['user']['user_id'],
                ];
                $referal->insertReferal($arr2['user_id']);    
                $lastreferal = $referal->getLastReferalByUserId($_SESSION['user']['user_id']);
                $_SESSION['appointment']['referal_id'] = $lastreferal;
                $appointment->insert($_SESSION['appointment']);
            } else {  
                $appointment->insert($_SESSION['appointment']);
            }
            
            // Fetch the latest appointment data
            $appointmentdata = $appointment->getLastAppointmentByUserId($userId);
            $_SESSION['appo_id'] = $appointmentdata['appointment_id'];

            // Redirect to the payment details page
            redirect('repatientpaymentdetails');
        }

        // Render the view
        $this->view('repatientchannel', $data);
    }
}