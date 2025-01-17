<?php

class Payment_Success {
    use Controller;
    public function index(){
        $appo_id = $_SESSION['appo_id'];
        $appointment = new Appointment;
        $appointmentdata = $appointment->first(['appointment_id' => $appo_id]);
        $arr['status'] = 'paid';
        $appointment->update($appo_id, $arr, 'appointment_id');
        
        $this->view('payment_success');
    }

    
    
}



