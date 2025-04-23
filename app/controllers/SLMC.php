<?php

class SLMC  {
    use Controller;
    public function index(){
        
        $id = $_GET['id'];
        $dr_request = new dr_request;
        
        $arr['req_id'] = $id;
       
        $data = $dr_request->first($arr);
       
      
       if($data){
            $this->view('SLMC', $data);
        }
    }
    
}


?>