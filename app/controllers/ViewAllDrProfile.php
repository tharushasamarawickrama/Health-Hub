<?php

class ViewAllDrProfile  {
    use Controller;
    public function index(){
        // echo "This is ViewDrProfile Controller";
        $doctor=new Doctor;
        $data=$doctor->findAlldata();
        print_r($data[0]['firstName']);
        $this->view('ViewAllDrProfile',$data);
    }
    
}


?>