<?php

class PatientChannel{
    use Controller;
    public function index(){

        $appointment = new Appointment;
        $userId = $_SESSION['user']['user_id'];
        $appointmentdata = $appointment->getLastAppointmentByUserId($userId);
       
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
        
        $schedule = new ScheduleTime;
       
        
        $arr['schedule_id']=$_SESSION['sch_id'];
        $scheduleData = $schedule->first($arr);
        
        if($scheduleData){
            $data = array_merge($data, $scheduleData);
        }
        if(isset($_POST['confirmbtn'])){
            $data['filled_slots'] = $data['filled_slots'] + 1;
            $schedule->update($data['schedule_id'], $data, 'schedule_id');
            $appointment->insert($_SESSION['appointment']);
            $appointmentdata = $appointment->getLastAppointmentByUserId($userId);
            $_SESSION['appo_id'] = $appointmentdata['appointment_id'];
            redirect('patientpaymentdetails');
        }
       
        $this->view('PatientChannel', $data);
        
        
       
    }
    
}