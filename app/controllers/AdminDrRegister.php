<?php

class AdminDrRegister  {
    use Controller;
    public function index(){
        $doctor = new Doctor;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = [
                'firstName' => $_POST['firstName'] ?? '',
                'lastName' => $_POST['lastName'] ?? '',
                'password' => $_POST['password'] ?? '',
                'phoneNumber' => $_POST['phoneNumber'] ?? '',
                'email' => $_POST['email'] ?? '',
                'specialization' => $_POST['specialization'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'dob' => $_POST['dob'] ?? '',
                'slmcNo' => $_POST['slmcNo'] ?? '',
                'nic' => $_POST['nic'] ?? '',
                'address' => $_POST['address'] ?? '',
                'photo_path' => $_POST['photo_path'] ?? '',
                
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

               

            if($doctor->insert($data)){
                
                // $data['success'] = "true";
                 $this->view('AdminDrRegister', $data);
                //  return $data;
                //header('Location: ' . URLROOT . '/ViewAllDrProfile');
            }
            redirect('AdminDrRegister');
         }
        

        $this->view('AdminDrRegister');

    }
    
}


?>