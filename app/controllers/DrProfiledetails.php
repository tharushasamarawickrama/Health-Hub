<?php

class DrProfiledetails  {
    use Controller;
    public function index(){
        

        
        $id = $_GET['id'];
        $doctor = new Doctor;
        $user = new User;
        $arr['doctor_id'] = $id;
        $arr2['user_id'] = $id;
        $data1 = $doctor->first($arr);
        $data2 = $user->first($arr2);
        $data = array_merge($data1, $data2);
        
        if($data){
            $this->view('DrProfiledetails', $data);
      
        
    }
    
}
}

?>