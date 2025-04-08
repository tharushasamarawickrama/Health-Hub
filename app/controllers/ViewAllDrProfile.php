<?php

class ViewAllDrProfile  {
    use Controller;
    public function index(){
       
        $doctor=new Doctor;
         //$data=$doctor->findAlldata();
        
    
       $searchQuery = $_GET['search'] ?? '';
   
        if (!empty($searchQuery)) {
            $data = $doctor->searchDoctors($searchQuery);
        } else {
            $data = $doctor->findAlldata();
        }

        $this->view('ViewAllDrProfile',$data);

    }
    public function delete(){
        $id=$_GET['id'];
        $doctor=new Doctor;
        if($doctor->delete($id,$id_column='doctor_id')){ 
            $data['success'] = "Doctor deleted Successfully";
            $this->view('AdminDrRegister', $data);
           
            
            return;
        }

    }
       
} 


?>