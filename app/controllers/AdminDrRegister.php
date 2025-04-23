<?php

class AdminDrRegister {
    use Controller;

    public function index() {
        $id = $_GET['id'] ?? null; 
        $dr_request = new dr_request;

        $data1 = null; 

        if ($id) {
            $arr['req_id'] = $id;
            $data1 = $dr_request->first($arr); 
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User;
            $doctor = new Doctor;

            
            $age = null;
            if (!empty($_POST['dob'])) {
                $dob = new DateTime($_POST['dob']);
                $today = new DateTime();
                $age = $today->diff($dob)->y;
            }

            
            $userData = [
                'title' => $data1['title'] ?? '',
                'firstName' => $_POST['firstName'] ?? '',
                'lastName' => $_POST['lastName'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phoneNumber' => $_POST['phoneNumber'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'dob' => $_POST['dob'] ?? '',
                'nic' => $_POST['nic'] ?? '',
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), 
                'address' => $_POST['address'] ?? '',
                'age' => $age ?? 0, 
                'photo_path' => $data1['photo_path'],
                'user_role' => 'doctor',
            ];

            // print_r($_FILES);
            // if (isset($_FILES['photo_path']) && $_FILES['photo_path']['error'] === 0) {
            //     $target_dir = "profile-Photos/";
            //     if (!is_dir($target_dir)) {
            //         mkdir($target_dir, 0777, true); // Create the directory if it doesn't exist
            //     }
            //     $file_name = basename($_FILES['photo_path']['name']);
            //     $target_file = $target_dir . uniqid() . '_' . $file_name;
            
            //     $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            //     $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            
               
            //     if (!in_array($file_type, $allowed_types)) {
                    
            //         $this->view('AdminDrRegister',  $data1);
            //         return;
            //     }
            
                
            //     if (getimagesize($_FILES['photo_path']['tmp_name']) === false) {
                    
            //         $this->view('AdminDrRegister', $data1);
            //         return;
            //     }
            
            //     // Move the uploaded file
            //     if (move_uploaded_file($_FILES['photo_path']['tmp_name'], $target_file)) {
            //         $userData['photo_path'] = $target_file; // Save the file path
            //     } else {
                   
            //         $this->view('AdminDrRegister', $data1 );
            //         return;
            //     }
            // }

            
            if ($user->insert($userData)) {
                $lastUserId = $user->getLastUserId(); 

                
                $doctorData = [
                    'doctor_id' => $lastUserId,
                    'slmcNo' => $_POST['slmcNo'] ?? '',
                    'description' => $data1['description'] ?? '',
                    'experience' => $_POST['experience'] ?? '',
                    'specialization' => $_POST['specialization'] ?? '',
                    'certifications' => $data1['certifications'] ?? '',
                    'availability' => 'Available',
                    'type' => $_POST['type'] ?? '',
                ];

                
                if ($doctor->insert($doctorData)) {
                    $data['success'] = "Doctor Registered Successfully!";
                    $this->view('AdminDrRegister', ['data1' => $data1, 'success' => $data['success']]);
                    return;
                }
            }

            $data['error'] = "Failed to register the doctor.";
            $this->view('AdminDrRegister', ['data1' => $data1, 'error' => $data['error']]);
            return;
            
        }

        
        $this->view('AdminDrRegister', ['data1' => $data1]); 
        
        
     

        
    }
    
}
?>