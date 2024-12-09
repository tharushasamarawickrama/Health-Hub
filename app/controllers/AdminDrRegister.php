<?php

class AdminDrRegister  {
    use Controller;
    public function index(){
        $doctor = new Doctor;
        $user = new User;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = [
                'Title' => 'Dr',
                'FirstName' => $_POST['firstName'] ?? '',
                'LastName' => $_POST['lastName'] ?? '',
                'Password' => $_POST['password'] ?? '',
                'PhoneNumber' => $_POST['phoneNumber'] ?? '',
                'Email' => $_POST['email'] ?? '',
                'Gender' => $_POST['gender'] ?? '',
                'NIC' => $_POST['nic'] ?? '',
                'Address' => $_POST['address'] ?? '',
                'photo_path' => $_POST['photo_path'] ?? '',
                'user_role' => 'doctor',
               

                
                
            ];

            
            
            if(isset($_FILES['photo_path'])){
                $target_dir = "profile-Photos/";
                if(!is_dir($target_dir)){
                    mkdir($target_dir,0777,true);
                }
                $file_name = basename($_FILES['photo_path']['name']);
                $target_file = $target_dir . uniqid() . '_' . $file_name;

                $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                if(!in_array($file_type, $allowed_types)){
                   $this->view('AdminDrRegister', $data);
                   return;
                }
                if(getimagesize($_FILES['photo_path']['tmp_name']) === false){
                    $this->view('AdminDrRegister', $data);
                    return;
                }
                if(move_uploaded_file($_FILES['photo_path']['tmp_name'], $target_file)){
                    $data['photo_path'] = $target_file;
                }else{
                    $this->view('AdminDrRegister', $data);
                    return;
                }}

               
            $arr['Email'] = $data['Email'];
            $row = $user->first($arr);
            if($row){
                $user->errors['Email'] = 'Email already exists';
                $data['errors'] = $user->errors;
                $this->view('AdminDrRegister', $data);
                return;
            }else{
                $user->insert($data);
                $arr['Email'] = $data['Email'];
                $row = $user->first($arr);
                $doctordata = ['user_id'=>$row['user_id']];
                $doctordata['specialization'] = $_POST['specialization'] ?? '';
                $doctordata['slmcNo'] = $_POST['slmcNo'] ?? '';
                $doctor->insert($doctordata);
            }  
           
            // redirect('AdminDrRegister');
         }
        

        $this->view('AdminDrRegister');

    }
    
}


?>