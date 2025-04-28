<?php

class DrProfile {
    use Controller;

    public function index() {
        $doctorId = $_SESSION['user']['user_id']; // Hardcoded doctor ID (can be dynamic based on session/login)
        if (isset($_SESSION['success_message'])) {
            echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
            unset($_SESSION['success_message']);
        }
        $userModel = new User();
        $doctorModel = new Doctor();
        $doctorProfileUpdateModel = new Doctor_Profile_Update();
        $userData =  $userModel->first(['user_id' => $doctorId]);
        $doctorData =  $doctorModel->first(['doctor_id' => $doctorId]);
        $requestExists = $doctorProfileUpdateModel->checkRequestExists($doctorId);
        // var_dump($requestExists);
        // exit;
        $this->view('drProfile', ['doctorData' => $doctorData, 'userData' => $userData, 'requestExists' => $requestExists]);
    }
}

