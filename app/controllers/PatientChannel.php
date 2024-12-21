<?php

class PatientChannel{
    use Controller;
    public function index(){

        $appointment = new Appointment;
        $arr['user_id'] = $_SESSION['user']['user_id'];
        $appointmentdata = $appointment->first($arr);
        // print_r($appointmentdata);
        if($appointmentdata){
            $doctor = new Doctor;
            $arr1['doctor_id'] = $appointmentdata['doctor_id'];
            $data = $doctor->first($arr1);
            if($data){
                $user = new User;
                $arr2['user_id'] = $data['user_id'];
                $data1 = $user->first($arr2);
                if($data1){
                    $data = array_merge($data, $data1);
                }
            }
        }
        
        $scedule = new ScheduleTime;
        $arr1['doctor_id'] = $appointmentdata['doctor_id'];
        $sceduledata = $scedule->first($arr1);
        if($sceduledata){
            $data = array_merge($data, $sceduledata);
        }
        // print_r($_SESSION['appointment']);

        $this->view('PatientChannel', $data);
    }
    
}