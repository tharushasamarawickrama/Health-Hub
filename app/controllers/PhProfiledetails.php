<?php

class PhProfiledetails  {
    use Controller;
    public function index(){
        
        $id = $_GET['id'];
        $pharmacist = new Pharmacist;
        $arr['pharmacist_id'] = $id;
        $data = $pharmacist->first($arr);
      
        if($data){
            $this->view('PhProfiledetails', $data);
        }
    }
    
}


?>