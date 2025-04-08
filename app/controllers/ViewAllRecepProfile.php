<?php

class ViewAllRecepProfile  {
    use Controller;
    public function index(){
        
        $receptionist=new Receptionist;
        //$data=$receptionist->findAlldata();
        $searchQuery = $_GET['search'] ?? '';

        if (!empty($searchQuery)) {
            $data = $receptionist->searchReceptionists($searchQuery);
        } else {
            $data = $receptionist->findAlldata();
        }
        
        $this->view('ViewAllRecepProfile',$data);
    }

    public function delete(){
        $id=$_GET['id'];
        $receptionist=new Receptionist;
        if($receptionist->delete($id,$id_column='receptionist_id')){
            redirect('ViewAllRecepProfile');
        }

    }
    
}


?>