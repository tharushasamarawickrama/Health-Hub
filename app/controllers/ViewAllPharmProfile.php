<?php

class ViewAllPharmProfile  {
    use Controller;
    public function index(){
       
        $pharmacist=new Pharmacist;
        //$data=$pharmacist->findAlldata();

        $searchQuery = $_GET['search'] ?? '';
   
        if (!empty($searchQuery)) {
            $data = $pharmacist->searchPharmacists($searchQuery);
        } else {
            $data = $pharmacist->findAlldata();
        }
        
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