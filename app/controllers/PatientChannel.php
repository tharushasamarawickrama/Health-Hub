<?php





class PatientChannel {
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
        $arr['schedule_id'] = $_SESSION['appointment']['schedule_id'];
        $scheduleData = $schedule->first($arr);

        if ($scheduleData) {
            $data = array_merge($data, $scheduleData);
        }
        $sameMonthAppointmentCount = $appointment->getSameMonthAndReferalAppointmentCount($userId, $_SESSION['appointment']['referal_id'], $_SESSION['appointment']['appointment_date']);   
        // show($sameMonthAppointmentCount); 
        $_SESSION['appointment']['sameMonthAppointmentCount'] = $sameMonthAppointmentCount;
        $data['appointment_date'] = $_SESSION['appointment']['appointment_date'];
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmbtn'])) {
            // Update filled slots in the schedule
            $data['filled_slots'] = $data['filled_slots'] + 1;
            $schedule->update($data['schedule_id'], $data, 'schedule_id');
            
            
            if($_SESSION['appointment']['referal_id'] == 'new'){

                $referal = new Patient_Referal;
                $arr2=[
                    'user_id' => $_SESSION['user']['user_id'],
                ];
                $referal->insertReferal($arr2['user_id']);    
                $lastreferal = $referal->getLastReferalByUserId($_SESSION['user']['user_id']);
                echo $lastreferal;
                $_SESSION['appointment']['referal_id'] = $lastreferal;
                $appointment->insert($_SESSION['appointment']);
            }else{  
                 
                $appointment->insert($_SESSION['appointment']);
            }
            
            // Insert appointment data into the database

            // Fetch the latest appointment data
            $appointmentdata = $appointment->getLastAppointmentByUserId($userId);
            $_SESSION['appo_id'] = $appointmentdata['appointment_id'];


            // Render the view
            redirect('Patientpaymentdetails');
        }
        // show($data);

    $this->view('PatientChannel', $data);

    
}

}