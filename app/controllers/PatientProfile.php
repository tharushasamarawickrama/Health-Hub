<?php

class PatientProfile{
    use Controller;
    public function index(){
        
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteProfile'])){
                $user = new User;
                $id = $_SESSION['user']['id'];
                $user->delete($id);
                session_destroy();
                redirect('patientregister?id=1');
            }
        
        $this->view('patientprofile');
    }
    
}