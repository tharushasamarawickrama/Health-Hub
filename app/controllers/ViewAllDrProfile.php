<?php

class ViewAllDrProfile  {
    use Controller;
    public function index(){
       
        $doctor = new Doctor();
        $data = $doctor->findAlldata();

        foreach ($data as &$key) { // Use reference to modify the original array
            $user = new User();
            $arr['user_id'] = $key['user_id'];
            $data1 = $user->first($arr);
            
            if ($data1) { // Check if user data is found
                $key = array_merge($key, $data1); // Merge data1 into key
            }
        }

        // Unset reference to avoid unexpected behavior
        unset($key);

        //print_r($data);
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