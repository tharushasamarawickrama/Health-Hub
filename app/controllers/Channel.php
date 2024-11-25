<?php

class Channel {
    use Controller;
    public function index(){
        // echo "This is Home Controller";
        $id = $_GET['id'];
        $doctor = new Doctor;
        $arr['doctor_id'] = $id;
        $data = $doctor->first($arr);
        
        $scedule = new ScheduleTime;
        if($_SESSION['appointment_date'] == ''){
            $data2 = $scedule->getScheduleByDoctor($id);
        }else{
            $data2 = $scedule->getSchedule($id, $_SESSION['appointment_date']);
        }
        
        //print_r($_SESSION['appointment_date']);
        //print_r($data2);
        $this->view('channel',$data, $data2);
    }
    
}