<?php

class ViewAllRecepProfile  {
    use Controller;
    public function index(){
        
        $receptionist=new Receptionist;
        $data=$receptionist->findAlldata();
        // print_r($data[0]['firstName']);
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