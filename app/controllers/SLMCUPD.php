<?php

class SLMCUPD  {
    use Controller;
    public function index(){
        
        $id = $_GET['id'];
        $dr_upd_req = new Doctor_Profile_Update;
        
        $arr['doctor_id'] = $id;
       
        $data = $dr_upd_req->first($arr);
       
      
       if($data){
            $this->view('SLMCUPD', $data);
        }

        
    }
    
}


?>