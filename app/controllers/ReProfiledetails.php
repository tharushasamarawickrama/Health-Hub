<?php

class ReProfiledetails  {
    use Controller;
    public function index(){
        
        $id = $_GET['id'];
        $receptionist = new Receptionist;
        $arr['receptionist_id'] = $id;
        $data = $receptionist->first($arr);
      
       if($data){
            $this->view('ReProfiledetails', $data);
        }
    }
    
}


?>