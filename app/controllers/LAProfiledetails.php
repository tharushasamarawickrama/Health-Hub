<?php

class LAProfiledetails  {
    use Controller;
    public function index(){
         
        $id = $_GET['id'];
        $labassistant = new LabAssistant;
        $arr['lab_assistant_id'] = $id;
        $data = $labassistant->first($arr);
        
      if($data){
        $this->view('LAProfiledetails', $data);
      }
        
    }
    
}


?>