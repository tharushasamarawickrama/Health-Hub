<?php

class DrRequest{
    use Controller;
    public function index(){
        $dr_request = new dr_request;
       
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            // print_r($_POST);
            // print_r($_FILES);
            // exit;

            
            $data = [
                'title' => 'Dr',
                'firstName' => $_POST['firstName'] ?? '',
                'lastName' => $_POST['lastName'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phoneNumber' => $_POST['phoneNumber'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'dob' => $_POST['dob'] ?? '',
                'nic' => $_POST['nic'] ?? '',
                'address' => $_POST['address'] ?? '',
                'age' => null,
                'photo_path' => '',
                'user_role' => 'doctor',
                'slmc_photo' => '',
                'slmcNo' => $_POST['slmcNo'] ?? '',
                'experience' => $_POST['experience'] ?? '',
                'specialization' => $_POST['specialization'] ?? '',
                'certifications' => $_POST['certifications'] ?? '',
                'description' => $_POST['description'] ?? '',
                'type' => $_POST['type'] ?? '',
            ];


            if (!empty($data['dob'])) {
                $dob = new DateTime($data['dob']);
                $today = new DateTime();
                $data['age'] = $today->diff($dob)->y;
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
                   $this->view('DrRequest', $data);
                   return;
                }
                if(getimagesize($_FILES['photo_path']['tmp_name']) === false){
                    $this->view('DrRequest', $data);
                    return;
                }
                if(move_uploaded_file($_FILES['photo_path']['tmp_name'], $target_file)){
                    $data['photo_path'] = $target_file;
                }else{
                    $this->view('DrRequest', $data);
                    return;
                }}



                if(isset($_FILES['slmc_photo'])){
                    $target_dir = "Certificate-images/";
                    if(!is_dir($target_dir)){
                        mkdir($target_dir,0777,true);
                    }
                    $file_name = basename($_FILES['slmc_photo']['name']);
                    $target_file = $target_dir . uniqid() . '_' . $file_name;
    
                    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                    if(!in_array($file_type, $allowed_types)){
                       $this->view('DrRequest', $data);
                       return;
                    }
                    if(getimagesize($_FILES['slmc_photo']['tmp_name']) === false){
                        $this->view('DrRequest', $data);
                        return;
                    }
                    if(move_uploaded_file($_FILES['slmc_photo']['tmp_name'], $target_file)){
                        $data['slmc_photo'] = $target_file;
                    }else{
                        $this->view('DrRequest', $data);
                        return;
                    }}
           
            // if ($dr_request->insert($data)) {
            //     $data['success'] = "Request submitted successfully!";
            //     $this->view('DrRequest', $data);
            //     return;
            // } 

            // $this->view('DrRequest', $data);
            // return;
                $dr_req_id = $dr_request->insert($data);
                if($dr_req_id){
                    $data['success'] = "Request submitted successfully!";
                    $this->view('DrRequest', $data);
                }else{
                    $data['error'] = "Failed to submit request!";
                    $this->view('DrRequest', $data);
                }
                
                redirect('DrRequest');
                return;

           
        }

        $this->view('DrRequest');

    }
    
}

?>