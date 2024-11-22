<?php

class SearchAppoinment {
    use Controller;
    public function index(){
        // echo "This is Home Controller";
        $doctor = new Doctor;
        $data = $doctor->findAlldata();
        $this->view('searchappoinment',$data);
    }
    
}