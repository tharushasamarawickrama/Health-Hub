<?php

class EditDrProfiledetails
{
    use Controller;
    public function index()
    {
        $id = $_GET['id'];
        $doctor = new Doctor;
        $arr['doctor_id'] = $id;
        $data = $doctor->first($arr);
        if (!$data) {
            
            $this->view('EditDrProfiledetails');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['drbutton'])) {
            $doctor = new Doctor;
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

            print_r($_FILES);
            if(isset($_FILES['photo_path']) && $_FILES['photo_path']['error'] == 0){
                    $target_dir = "profile-Photos/";
                if(!is_dir($target_dir)){
                        mkdir($target_dir,0777,true);
                    }
                    $file_name = basename($_FILES['photo_path']['name']);
                    $target_file = $target_dir . uniqid() . '_' . $file_name;
                
                    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                if(!in_array($file_type, $allowed_types)){
                       $this->view('EditDrProfiledetails', $data);
                   return;
                }
                if(getimagesize($_FILES['photo_path']['tmp_name']) === false){
                        $this->view('EditDrProfiledetails', $data);
                    return;
                }
                if(move_uploaded_file($_FILES['photo_path']['tmp_name'], $target_file)){
                    $data['photo_path'] = $target_file;
                }else{
                        $this->view('EditDrProfiledetails', $data);
                        return;
                    }}
            // print_r($doctor->update($id, $data, 'doctor_id'));
            
            $result=$doctor->update($id, $data, 'doctor_id');
            if ($result) {
                redirect('DrProfiledetails', $id);  
                exit(); // Always add exit after redirecting
            } 
            else {
                echo "Update failed.";
            }
        }
        $this->view('EditDrProfiledetails', $data);

    }
}
