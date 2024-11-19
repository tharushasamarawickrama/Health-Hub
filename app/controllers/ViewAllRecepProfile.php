<?php

class ViewAllRecepProfile  {
    use Controller;
    public function index(){
        // echo "This is ViewDrProfile Controller";
        $receptionist=new Receptionist;
        $data=$receptionist->findAlldata();
        print_r($data[0]['firstName']);
        $this->view('ViewAllRecepProfile',$data);
    }
    
}


?>