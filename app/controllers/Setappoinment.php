<?php

class Setappoinment {
    use Controller;
    public function index(){
        // echo "This is Home Controller";
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)){
            $id = $_GET['id'];
            $sch_id = $_GET['sch_id'];
            $appoinment = new Appointment;
            $schedule = new ScheduleTime;
            

            $data = [
                'p_firstName' => $_POST['p_firstName'],
                'p_lastName' => $_POST['p_lastName'],
                'nic' => $_POST['nic'],
                'phoneNumber' => $_POST['phoneNumber'],
                'address' => $_POST['address'],
                'email' => $_POST['email'],
                'add_service' => $_POST['addservice'],
                'doctor_id' => $id,
                'patient_id' => $_SESSION['user']['user_id'],
                'payment_status' => 'pending',
                
                
            ];
            
            $_SESSION['sch_id'] = $sch_id;
            $scheduleData = $schedule->first(['schedule_id' => $sch_id]);
            $data['appointment_No'] = $scheduleData['filled_slots'] + 1;
            
            $data['appointment_date'] = $scheduleData['date'];
            $_SESSION['appointment'] = $data;
            
          
            redirect('patientchannel');

        }
        $this->view('setappoinment');
         
    }
    
}