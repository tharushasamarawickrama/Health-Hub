<?php

class LAProfiledetails  {
    use Controller;
    public function index(){
         
        $id = $_GET['id'];
        $labassistant = new LabAssistant;
        $user = new user;
        $arr['lab_assistant_id'] = $id;
        $arr2['user_id'] = $id;
        $data1 = $labassistant->first($arr);
        $data2 = $user->first($arr2);
        $data = array_merge($data1, $data2);
        
      if($data){
        $this->view('LAProfiledetails', $data);
      }
        
    }
    
}


?>