<?php

class ViewAllLabAssiProfile  {
    use Controller;
    public function index(){
        
        $labassistant=new LabAssistant;
        $data=$labassistant->findAlldata();
        // print_r($data[0]['firstName']);
        $this->view('ViewAllLabAssiProfile',$data);
    }
    public function delete(){
        $id=$_GET['id'];
        $labassistant=new LabAssistant;
        if($labassistant->delete($id,$id_column='lab_assistant_id')){
            redirect('ViewAllLabAssiProfile');
        }

    }
    
}


?>