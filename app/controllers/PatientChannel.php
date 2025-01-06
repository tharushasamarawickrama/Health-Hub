<?php

class PatientChannel{
    use Controller;
    public function index(){

        $appointment = new Appointment;
        $userId = $_SESSION['user']['user_id'];
        $appointmentdata = $appointment->getLastAppointmentByUserId($userId);
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
                    print_r($data);
                }
            }
        }
        
        $scedule = new ScheduleTime;
        $arr1['schedule_id'] = $_SESSION['sch_id'];
        $sceduledata = $scedule->first($arr1);
        if($sceduledata){
            $data = array_merge($data, $sceduledata);
        }
        // print_r($_SESSION['appointment']);
        // print_r($data);
        $this->view('PatientChannel', $data);
    }
    
}