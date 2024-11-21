<?php

class PatientChannel{
    use Controller;
    public function index(){
        
        $this->view('PatientChannel');
    }
    
}