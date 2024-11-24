<?php

class DrProfile {
    use Controller;

    public function index() {
        $doctorId = 5; // Hardcoded doctor ID (can be dynamic based on session/login)
        if (isset($_SESSION['success_message'])) {
            echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
            unset($_SESSION['success_message']);
        }
        $doctorModel = new Doctor();
        $doctorData =  $doctorModel->first(['doctor_id' => $doctorId]);
        $this->view('drProfile', ['doctorData' => $doctorData]);
    }
}

