<?php

class ViewAllDrProfile  {
    use Controller;
    public function index(){
        // echo "This is ViewDrProfile Controller";
        $doctor=new Doctor;
        $data=$doctor->findAlldata();
        
        $this->view('ViewAllDrProfile',$data);
    }
    
}


?>