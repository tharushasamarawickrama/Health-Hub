<?php

class ViewAllPharmProfile  {
    use Controller;
    public function index(){
        // echo "This is ViewDrProfile Controller";
        $pharmacist=new Pharmacist;
        $data=$pharmacist->findAlldata();
        print_r($data[0]['firstName']);
        $this->view('ViewAllPharmProfile',$data);
    }
    
}


?>