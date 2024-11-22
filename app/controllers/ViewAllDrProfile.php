<?php

class ViewAllDrProfile  {
    use Controller;
    public function index(){
        // echo "This is ViewDrProfile Controller";
        $doctor=new Doctor;
        $data=$doctor->findAlldata();
        
        $this->view('ViewAllDrProfile',$data);

        if(isset($_POST['delete_doctor_button'])){
            $doctor=new Doctor;
            $id=$data[0]['doctor_id'];
            if($doctor->delete($id)){
                redirect('ViewAllDrProfile');
            }
           
        }
    }
       
}


?>