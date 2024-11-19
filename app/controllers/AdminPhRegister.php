<?php

class AdminPhRegister  {
    use Controller;
    public function index(){
        $pharmacist = new Pharmacist;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = [
                'firstName' => $_POST['firstName'] ?? '',
                'lastName' => $_POST['lastName'] ?? '',
                'password' => $_POST['password'] ?? '',
                'phoneNumber' => $_POST['phoneNumber'] ?? '',
                'email' => $_POST['email'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'dob' => $_POST['dob'] ?? '',
                'slmcNo' => $_POST['slmcNo'] ?? '',
                'nic' => $_POST['nic'] ?? '',
                'address' => $_POST['address'] ?? '',
                'photo_path' => $_POST['photo_path'] ?? '',
                
            ];

            if($pharmacist->insert($data)){
                header('Location: ' . URLROOT . '/AdminPhRegister');
        }}
        $this->view('AdminPhRegister');
    }
    
}


?>