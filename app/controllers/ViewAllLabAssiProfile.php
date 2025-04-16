<?php

class ViewAllLabAssiProfile  {
    use Controller;
    public function index(){
        
        $labassistant=new LabAssistant;
       
        $searchQuery = $_GET['search'] ?? '';

        if (!empty($searchQuery)) {
            $data = $labassistant->searchLabAssistants($searchQuery);
        } else {
            $data = $labassistant->findAlldata();
        }

        $this->view('ViewAllLabAssiProfile',$data);
    }
    public function delete(){
        $id=$_GET['id'];
        $labassistant=new LabAssistant;
        $user=new User;
        if($labassistant->delete($id,$id_column='lab_assistant_id') && $user->delete($id,$id_column='user_id')){
            redirect('ViewAllLabAssiProfile');
        }

    }
    
}


?>