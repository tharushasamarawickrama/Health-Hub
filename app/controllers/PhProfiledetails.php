<?php

class PhProfiledetails  {
    use Controller;
    public function index(){
        
        $id = $_GET['id'];
        $pharmacist = new Pharmacist;
        $arr['pharmacist_id'] = $id;
        $data = $pharmacist->first($arr);

        if($data){
            $user = new User;
            $arr1['user_id'] = $data['user_id'];
            $data1 = $user->first($arr1);
            if($data1){
                $data = array_merge($data, $data1);
            }
        }
      
        if($data){
            $this->view('PhProfiledetails', $data);
        }
    }
    
}


?>