<?php

class Patientpaymentdetails
{
    use Controller;
    public function index()
    {
        // echo "This is Home Controller";
        if (isset($_GET['appo_id'])) {
            $appoid = $_GET['appo_id'];
            $appointment = new Appointment;
            $arr['appointment_id'] = $appoid;
            $data = $appointment->first($arr);

            $appointment = new Appointment;
            $sameMonthAppointmentCount = $appointment->getSameMonthAndReferalAppointmentCount($_SESSION['user']['user_id'], $data['referal_id'], $data['appointment_date']);
            show($sameMonthAppointmentCount);
            $data['sameMonthAppointmentCount'] = $sameMonthAppointmentCount;
            $data['appo_id'] = $appoid;
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancelbtn'])){
                $cancelappodata = new Appointment;
                $cancelappo = $cancelappodata->getAppointmentById($appoid);
                $cancelappo['isdeleted'] = 1;
                $schedule = new ScheduleTime;
                $arr1['schedule_id'] = $cancelappo['schedule_id'];
                $scheduledata = $schedule->first($arr1);
                $arr2['filled_slots'] = $scheduledata['filled_slots']-1;
                $schedule->update($arr1['schedule_id'],$arr2,'schedule_id');
                $cancelappodata->update($cancelappo['appointment_id'],$cancelappo,'appointment_id');
                redirect('home');
                
            }
            $this->view('Patientpaymentdetails', $data);
        }else{
            $appoid = $_SESSION['appo_id'];
            $appointment = new Appointment;
            $arr['appointment_id'] = $appoid;
            $data = $appointment->first($arr);
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancelbtn'])){
                $cancelappodata = new Appointment;
                $cancelappo = $cancelappodata->getLastAppointmentByUserId($_SESSION['user']['user_id']);
                $cancelappo['isdeleted'] = 1;
                $schedule = new ScheduleTime;
                $arr1['schedule_id'] = $cancelappo['schedule_id'];
                $scheduledata = $schedule->first($arr1);
                $arr2['filled_slots'] = $scheduledata['filled_slots']-1;
                $schedule->update($arr1['schedule_id'],$arr2,'schedule_id');
                $cancelappodata->update($cancelappo['appointment_id'],$cancelappo,'appointment_id');
                redirect('home');
                
            }
            // show($data);
            $this->view('Patientpaymentdetails', $data);
        }
    }
}
