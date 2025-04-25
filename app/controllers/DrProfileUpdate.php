<?php

class DrProfileUpdate  {
    use Controller;
    public function index(){
        
        $dr_prop_update=new Doctor_Profile_Update;
        $data=$dr_prop_update->findAlldata();
        
        
        $this->view('DrProfileUpdate',$data);
    }

    public function delete(){
        $id=$_GET['id'];
        $dr_prop_update=new Doctor_Profile_Update;
        
        if($dr_prop_update->delete($id,$id_column='doctor_id') ){
            redirect('DrProfileUpdate');
            
        }else {
            echo "Failed to delete the record.";
        }
        
        

    }
    
}


?>