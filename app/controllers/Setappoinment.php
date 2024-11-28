<?php

class Setappoinment {
    use Controller;
    public function index(){
        // echo "This is Home Controller";
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)){
            $id = $_GET['id'];
            $appoinment = new Appointment;

            

            $data = [
                'p_firstName' => $_POST['p_firstName'],
                'p_lastName' => $_POST['p_lastName'],
                'nic' => $_POST['nic'],
                'phoneNumber' => $_POST['phoneNumber'],
                'address' => $_POST['address'],
                'email' => $_POST['email'],
                'add_service' => $_POST['addservice'],
                'doctor_id' => $id,
                'user_id' => $_SESSION['user']['id'],
                
            ];
            
            // print_r($data);
            if($appoinment->insert($data)){
                redirect('patientchannel');
            }else{
                 $this->view('setappoinment');  
            }

        }
        $this->view('setappoinment');
         
    }
    
}