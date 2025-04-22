<?php

class AdminDashboard{
    use Controller;
    public function index(){
        // $dr_request = new dr_request();
        // $requestCount1 = $dr_request->get_dr_requestCount();
        // echo "Total Doctor Requests: " . $requestCount1;
        // $doctor = new Doctor();
        // $requestCount2 = $doctor->get_doctors_Count();
        // echo "  Total Doctors: " . $requestCount2;
        $this->view('Admindashboard');
    }
    
}

?>