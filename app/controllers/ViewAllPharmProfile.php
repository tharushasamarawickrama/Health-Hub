<?php

class ViewAllPharmProfile  {
    use Controller;
    public function index(){
       
        $pharmacist=new Pharmacist;
        $data=$pharmacist->findAlldata();
        print_r($data[0]['firstName']);
        $this->view('ViewAllPharmProfile',$data);
    }

    public function delete(){
        $id=$_GET['id'];
        $pharmacist=new Pharmacist;
        if($pharmacist->delete($id,$id_column='pharmacist_id')){
            redirect('ViewAllPharmProfile');
        }

    }
    
}


?>