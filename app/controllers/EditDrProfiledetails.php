<?php

class EditDrProfiledetails
{
    use Controller;
    public function index()
    {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            die("Error: Missing or invalid doctor ID.");
        }

        $id = $_GET['id'];
        $doctor = new Doctor;
        $user = new User;
        $arr['doctor_id'] = $id;
        $arr2['user_id'] = $id;
        $data1 = $doctor->first($arr);
        $data2 = $user->first($arr2);

        if (!$data1 || !$data2) {
            die("Error: Doctor or user data not found.");
        }

        $data = array_merge($data1, $data2);
        if (!$data) {
            
            $this->view('EditDrProfiledetails');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['drbutton'])) {
            
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

            // show($data);
            
            if (isset($_FILES['photo_path']) && $_FILES['photo_path']['error'] == 0) {
                $target_dir = "profile-Photos/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $file_name = basename($_FILES['photo_path']['name']);
                $target_file = $target_dir . uniqid() . '_' . $file_name;

                $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                if (!in_array($file_type, $allowed_types)) {
                    $data['error'] = "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
                    $this->view('EditDrProfiledetails', $data);
                    return;
                }
                if (getimagesize($_FILES['photo_path']['tmp_name']) === false) {
                    $data['error'] = "The uploaded file is not a valid image.";
                    $this->view('EditDrProfiledetails', $data);
                    return;
                }
                if (move_uploaded_file($_FILES['photo_path']['tmp_name'], $target_file)) {
                    $data['photo_path'] = $target_file; // Save the new file path
                } else {
                    $data['error'] = "Failed to upload the file.";
                    $this->view('EditDrProfiledetails', $data);
                    return;
                }
            } else {
                // Retain the old photo_path if no new file is uploaded
                $data['photo_path'] = $data2['photo_path'] ?? '';
            }
                        // print_r($doctor->update($id, $data, 'doctor_id'));
            // show($data);
            $result=$user->update($id, $data,'user_id');
                    echo $result;
            if ($result) {
                redirect('DrProfiledetails', $id);  
                // exit(); // Always add exit after redirecting
            } 
            else {
                echo "Update failed.";
            }
        }
        $this->view('EditDrProfiledetails', $data);

    }
}
