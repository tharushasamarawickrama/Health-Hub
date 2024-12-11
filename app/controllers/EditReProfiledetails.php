<?php

class EditReProfiledetails
{
    use Controller;
    public function index()
    {
        $id = $_GET['id'];
        $receptionist = new Receptionist;
        $arr['receptionist_id'] = $id;
        $data = $receptionist->first($arr);

        if ($data) {
            $user = new User;
            $arr1['user_id'] = $data['user_id'];
            $id1 = $data['user_id'];
            $data1 = $user->first($arr1);
            if ($data1) {
                $data = array_merge($data, $data1);
            }
        }
        if (!$data) {
            
            $this->view('EditReProfiledetails');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rebutton'])) {
            $receptionist = new Receptionist;
            $data1 = [
                'FirstName' => $_POST['firstName'] ?? '',
                'LastName' => $_POST['lastName'] ?? '',
                'Password' => $_POST['password'] ?? '',
                'PhoneNumber' => $_POST['phoneNumber'] ?? '',
                'Email' => $_POST['email'] ?? '',
                'Gender' => $_POST['gender'] ?? '',
                'dob' => $_POST['dob'] ?? '',
                'NIC' => $_POST['nic'] ?? '',
                'Address' => $_POST['address'] ?? '',
                
                
            ];

            $data2 = [
                'user_id' => $id1,
                'employeeNo' => $_POST['employeeNo'] ?? '',
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
                       $this->view('EditReProfiledetails', $data);
                   return;
                }
                if(getimagesize($_FILES['photo_path']['tmp_name']) === false){
                        $this->view('EditReProfiledetails', $data);
                    return;
                }
                if(move_uploaded_file($_FILES['photo_path']['tmp_name'], $target_file)){
                    $data1['photo_path'] = $target_file;
                }else{
                        $this->view('EditReProfiledetails', $data);
                        return;
                    }}
            // print_r($doctor->update($id, $data, 'doctor_id'));
            $result1=$user->update($id1, $data1, 'user_id');
            $result2=$receptionist->update($id, $data2, 'receptionist_id');
            if ($result1 && $result2) {
                redirect('ReProfiledetails', $id);  
                exit(); // Always add exit after redirecting
            } 
            else {
                echo "Update failed.";
            }
        }
        $this->view('EditReProfiledetails', $data);

    }
}
