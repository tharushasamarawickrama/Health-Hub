<?php

class AdminRecepRegister  {
    use Controller;
    public function index(){
        $receptionist = new Receptionist;
        $user = new User;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = [
                'title' => $_POST['title'] ?? '',
                'firstName' => $_POST['firstName'] ?? '',
                'lastName' => $_POST['lastName'] ?? '',
                'password' => $_POST['password'] ?? '',
                'phoneNumber' => $_POST['phoneNumber'] ?? '',
                'email' => $_POST['email'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'dob' => $_POST['dob'] ?? '',
                'employeeNo' => $_POST['employeeNo'] ?? '',
                'nic' => $_POST['nic'] ?? '',
                'address' => $_POST['address'] ?? '',
                'photo_path' => $_POST['photo_path'] ?? '',
                'user_role' =>  'receptionist',
                
            ];


            if (!empty($data['dob'])) {
                $dob = new DateTime($data['dob']);
                $today = new DateTime();
                $age = $today->diff($dob)->y; 
                $data['age'] = $age;
            } else {
                $data['age'] = null; 
            }
           

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
                   $this->view('AdminRecepRegister', $data);
                   return;
                }
                if(getimagesize($_FILES['photo_path']['tmp_name']) === false){
                    $this->view('AdminRecepRegister', $data);
                    return;
                }
                if(move_uploaded_file($_FILES['photo_path']['tmp_name'], $target_file)){
                    $data['photo_path'] = $target_file;
                }else{
                    $this->view('AdminRecepRegister', $data);
                    return;
                }}

        //         if($receptionist->insert($data)){
        //             header('Location: ' . URLROOT . '/AdminRecepRegister');
        //         }
        //         else{
        //             //failed massage
        //         }
        //    redirect('AdminRecepRegister');
        //     return;
               
        $user_id = $user->insert($data);
        
        if ($user_id) {
            
            $dataid = $user->getLastUserId();
            
            
            if ($receptionist->insert(['receptionist_id' => $dataid, 'employeeNo' => $data['employeeNo']])) {
                
                $data['success'] = "Receptionist added successfully!";
                $this->view('AdminRecepRegister', $data);

                //redirect('AdminRecepRegister');
                return;
            }
        }

        $this->view('AdminRecepRegister', $data);
        return;
        
        
    }
        $this->view('AdminRecepRegister');
    }
    
}


?>