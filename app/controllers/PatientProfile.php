<?php

class PatientProfile{
    use Controller;
    public function index(){
       
        
            if(isset($_POST['delete'])){
                $user = new User;
                $id = $_SESSION['user']['id'];
                $user->delete($id);
                session_destroy();
                redirect('patientregister');
            }
        
        $this->view('patientprofile');
    }
    
}