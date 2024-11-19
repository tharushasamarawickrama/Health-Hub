<?php

class ViewAllLabAssiProfile  {
    use Controller;
    public function index(){
        // echo "This is ViewDrProfile Controller";
        $labassistant=new LabAssistant;
        $data=$labassistant->findAlldata();
        print_r($data[0]['firstName']);
        $this->view('ViewAllLabAssiProfile',$data);
    }
    
}


?>