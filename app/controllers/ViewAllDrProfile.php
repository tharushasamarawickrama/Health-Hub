<?php

class ViewAllDrProfile  {
    use Controller;
    public function index(){
       
        $doctor=new Doctor;
         
        
    
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
        $user=new User;
        if($doctor->delete($id,$id_column='doctor_id') && $user->delete($id,$id_column='user_id')){ 
            $data['success'] = "Doctor deleted Successfully";
            $this->view('AdminDrRegister', $data);
           
            
            return;
        }

    }
       
} 


?>