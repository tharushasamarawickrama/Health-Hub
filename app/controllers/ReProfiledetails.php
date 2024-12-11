<?php

class ReProfiledetails  {
    use Controller;
    public function index(){
        
        $id = $_GET['id'];
        $receptionist = new Receptionist;
        $arr['receptionist_id'] = $id;
        $data = $receptionist->first($arr);
        if($data){
            $user = new User;
            $arr1['user_id'] = $data['user_id'];
            $data1 = $user->first($arr1);
            if($data1){
                $data = array_merge($data, $data1);
            }
        }   
      
       if($data){
            $this->view('ReProfiledetails', $data);
        }
    }
    
}


?>