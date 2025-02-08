<?php

class DrProfiledetails  {
    use Controller;
    public function index(){
        

        
        $id = $_GET['id'];
        $doctor = new Doctor;
        $arr['doctor_id'] = $id;
        $data = $doctor->first($arr);
        
        if($data){
            $this->view('DrProfiledetails', $data);
      
        
    }
    
}
}

?>