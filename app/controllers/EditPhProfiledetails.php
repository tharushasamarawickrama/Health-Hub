<?php

class EditPhProfiledetails
{
    use Controller;
    public function index()
    {
        $id = $_GET['id'];
        $pharmacist = new Pharmacist;
        $user = new User;
        $arr['pharmacist_id'] = $id;
        $arr2['user_id'] = $id;
        $data1 = $pharmacist->first($arr);
        $data2 = $user->first($arr2);
        $data = array_merge($data1, $data2);
        if (!$data) {
            
            $this->view('EditPhProfiledetails');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rebutton'])) {
            $pharmacist = new Pharmacist;
            $data = [
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
                       $this->view('EditPhProfiledetails', $data);
                   return;
                }
                if(getimagesize($_FILES['photo_path']['tmp_name']) === false){
                        $this->view('EditPhProfiledetails', $data);
                    return;
                }
                if(move_uploaded_file($_FILES['photo_path']['tmp_name'], $target_file)){
                    $data['photo_path'] = $target_file;
                }else{
                        $this->view('EditPhProfiledetails', $data);
                        return;
                    }}
            // print_r($doctor->update($id, $data, 'doctor_id'));
            
            $result=$user->update($id, $data, 'user_id');
            //echo $result;
            if ($result) {
                redirect('PhProfiledetails', $id);  
                //exit(); // Always add exit after redirecting
            } 
            else {
                echo "Update failed.";
            }
        }
        $this->view('EditPhProfiledetails', $data);

    }
}
