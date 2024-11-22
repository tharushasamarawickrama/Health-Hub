<?php

class ViewAllDrProfile  {
    use Controller;
    public function index(){
        // echo "This is ViewDrProfile Controller";
        $doctor=new Doctor;
        $data=$doctor->findAlldata();
        print_r($data[0]['firstName']);
        $this->view('ViewAllDrProfile',$data);

    }
    public function delete(){
        $id=$_GET['id'];
        $doctor=new Doctor;
        if($doctor->delete($id,$id_column='doctor_id')){
            redirect('ViewAllDrProfile');
        }

    }
       
} 


?>