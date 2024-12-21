<?php

class Setappoinment {
    use Controller;
    public function index(){
        // echo "This is Home Controller";
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)){
            $id = $_GET['id'];
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
                'user_id' => $_SESSION['user']['user_id'],
                
                
            ];
            
            $_SESSION['appointment'] = $data;
            $scheduleData = $schedule->first(['doctor_id' => $id]);
            $arr['filled_slots'] = $scheduleData['filled_slots'] + 1;
            $schedule->update($scheduleData['schedule_id'], $arr, 'schedule_id');

            $data['appointment_date'] = $scheduleData['date'];
            
            print_r($data);
            if($appoinment->insert($data)){
                redirect('patientchannel');
            }else{
                 $this->view('setappoinment');  
            }

        }
        $this->view('setappoinment');
         
    }
    
}