<?php

class PatientRegister {
    use Controller;
    public function index(){
        $user = new User;
        // echo "This is Home Controller";
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = [
                'Title' => $_POST['Title'] ?? '',
                'FirstName' => $_POST['FirstName'] ?? '',
                'LastName' => $_POST['LastName'] ?? '',
                'Email' => $_POST['Email'] ?? '',
                'PhoneNumber' => $_POST['PhoneNumber'] ?? '',
                'NIC' => $_POST['NIC'] ?? '',
                'Gender' => $_POST['gender'] ?? '',
                'Password' => $_POST['Password'] ?? '',
                'Address' => $_POST['Address'] ?? '',
                'Age' => $_POST['Age'] ?? ''
            ];

            $user->insert($data);
            
        }

        
        $this->view('patientregister');
    }

    
   
    
}
    
