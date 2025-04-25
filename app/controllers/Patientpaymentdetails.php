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
            $this->view('Patientpaymentdetails', $data);
        }else{
            $appoid = $_SESSION['appo_id'];
            $appointment = new Appointment;
            $arr['appointment_id'] = $appoid;
            $data = $appointment->first($arr);
            // show($data);
            $this->view('Patientpaymentdetails', $data);
        }
    }
}
