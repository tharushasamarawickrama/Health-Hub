<?php

class PhProfiledetails  {
    use Controller;
    public function index(){
        
        $id = $_GET['id'];
        $pharmacist = new Pharmacist;
        $user = new User;
        $arr['pharmacist_id'] = $id;
        $arr2['user_id'] = $id;
        $data1 = $pharmacist->first($arr);
        $data2 = $user->first($arr2);
        $data = array_merge($data1, $data2);
      
        if($data){
            $this->view('PhProfiledetails', $data);
        }
    }
    
}


?>