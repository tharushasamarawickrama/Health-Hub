<?php

class DrProfile {
    use Controller;

    public function index() {
        $doctorId = 8; // Hardcoded doctor ID (can be dynamic based on session/login)
        if (isset($_SESSION['success_message'])) {
            echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
            unset($_SESSION['success_message']);
        }
        $userModel = new User();
        $doctorModel = new Doctor();
        $userData =  $userModel->first(['user_id' => $doctorId]);
        $doctorData =  $doctorModel->first(['doctor_id' => $doctorId]);
        $this->view('drProfile', ['doctorData' => $doctorData, 'userData' => $userData]);
    }
}

