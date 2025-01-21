<?php

class SearchAppoinment {
    use Controller;
    public function index(){
        // echo "This is Home Controller";
        $v1 = $_GET['v1'] ?? '';
        $doctor = new Doctor;
        $data = $doctor->findAlldata();
        foreach($data as &$key){
            $user = new User;
            $arr['user_id'] = $key['doctor_id'];
            $data1 = $user->first($arr);
            if($data1){
                $key = array_merge($key, $data1);
            }
        }
        unset($key);
        
        $data2 = [];
        if(isset($_POST['search'])){
            $doctor1 = new Doctor;
           
            $data1 = [
                'doctor' => $_POST['doctor'] ?? '',
                'specialization' => $_POST['specialization'] ?? '',
                'appointment_date' => $_POST['appointment_date'] ?? '',
            ];
            $_SESSION['appointment_date'] = $data1['appointment_date'];
            $nameparts = explode(" ",$data1['doctor']);
            $arr['firstName'] = $nameparts[0] ? $nameparts[0] : '';
            $arr['lastName'] = $nameparts[1]? $nameparts[1] : '';

            $arr['specialization'] = $data1['specialization'] ?? '';
            $data2 = $doctor1->findDoctors($arr);
            
            // print_r($data2);
            foreach ($data2 as &$doctor) {
                $doctor['appointment_date'] = $data1['appointment_date'];
            }
        

        }
        $this->view('searchappoinment', $data, $data2);

        
    }
    
}