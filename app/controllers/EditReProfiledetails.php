<?php

class EditReProfiledetails
{
    use Controller;
    public function index()
    {   
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            die("Error: Missing or invalid receptionist ID.");
        }

        $id = $_GET['id'];
        $receptionist = new Receptionist;
        $user = new User;
        $arr['receptionist_id'] = $id;
        $arr2['user_id'] = $id;
        $data1 = $receptionist->first($arr);
        $data2 = $user->first($arr2);

        if (!$data1 || !$data2) {
            die("Error: Receptionist or user data not found.");
        }

        $data = array_merge($data1, $data2);
        if (!$data) {
            
            $this->view('EditReProfiledetails');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rebutton'])) {
            $receptionist = new Receptionist;
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
                       $this->view('EditReProfiledetails', $data);
                   return;
                }
                if(getimagesize($_FILES['photo_path']['tmp_name']) === false){
                        $this->view('EditReProfiledetails', $data);
                    return;
                }
                if(move_uploaded_file($_FILES['photo_path']['tmp_name'], $target_file)){
                    $data['photo_path'] = $target_file;
                }else{
                        $this->view('EditReProfiledetails', $data);
                        return;
                }}
                else{
                    $data['photo_path'] = $data2['photo_path'];
                }
            // print_r($doctor->update($id, $data, 'doctor_id'));
            
            $result=$user->update($id, $data, 'user_id');
            //echo $result;
            if ($result) {
                redirect('ReProfiledetails', $id);  
                //exit(); // Always add exit after redirecting
            } 
            else {
                echo "Update failed.";
            }
        }
        $this->view('EditReProfiledetails', $data);

    }
}
