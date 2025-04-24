<?php

class ReProfiledetails  {
    use Controller;
    public function index(){
        
        $id = $_GET['id'];
        $receptionist = new Receptionist;
        $user = new User;
        $arr['receptionist_id'] = $id;
        $arr2['user_id'] = $id;
        $data1 = $receptionist->first($arr);
        $data2 = $user->first($arr2);
        $data = array_merge($data1, $data2);
      
       if($data){
            $this->view('ReProfiledetails', $data);
        }
    }
    
}


?>