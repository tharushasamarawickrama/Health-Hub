<?php

class AdminRecepRegister  {
    use Controller;
    public function index(){
        $receptionist = new Receptionist;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = [
                'firstName' => $_POST['firstName'] ?? '',
                'lastName' => $_POST['lastName'] ?? '',
                'password' => $_POST['password'] ?? '',
                'phoneNumber' => $_POST['phoneNumber'] ?? '',
                'email' => $_POST['email'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'dob' => $_POST['dob'] ?? '',
                'employeeNo' => $_POST['employeeNo'] ?? '',
                'nic' => $_POST['nic'] ?? '',
                'address' => $_POST['address'] ?? '',
                'photo_path' => $_POST['photo_path'] ?? '',
                
            ];

            if($receptionist->insert($data)){
                header('Location: ' . URLROOT . '/AdminRecepRegister');
        }}
        $this->view('AdminRecepRegister');
    }
    
}


?>