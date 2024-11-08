<?php

class PatientRegister {
    use Controller;

    public function index() {
        $user = new User;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if this is a login or registration request
            if (isset($_POST['login'])) {
                
                    // Login logic
                    $arr['NIC'] = $_POST['logNIC'] ?? '';
                
                    $row = $user->first($arr);
            
                    // Check if the array $row has a password and validate it
                    if ($row && isset($row['Password']) && $row['Password'] == $_POST['logPassword']) {
                        show($row);  // Show row details for debugging
                        $_SESSION['user'] = $row;
                        redirect('searchappoinment'); // Redirect after successful login
                    } else {
                        $user->errors['Email'] = "Invalid Email or Password";
                        $data['errors'] = $user->errors;
                        $this->view('patientregister', $data); // Redirect after unsuccessful login
                    }
                
                
            

            } else {
                // Registration logic
                $data = [
                    'Title' => $_POST['Title'] ?? '',
                    'FirstName' => $_POST['FirstName'] ?? '',
                    'LastName' => $_POST['LastName'] ?? '',
                    'Email' => $_POST['Email'] ?? '',
                    'PhoneNumber' => $_POST['PhoneNumber'] ?? '',
                    'NIC' => $_POST['NIC'] ?? '',
                    'Gender' => $_POST['gender'] ?? '',
                    'Password' =>$_POST['Password'], // Hash password
                    'Address' => $_POST['Address'] ?? '',
                    'Age' => $_POST['Age'] ?? ''
                ];
                $arr['NIC'] = $_POST['NIC'] ?? '';
                $row = $user->first($arr);
                if($row){
                    $user->errors['NIC'] = "NIC already exists, please login";
                    $data['errors'] = $user->errors;
                    $this->view('patientregister', $data);
                }else{
                    $user->insert($data);
                    $this->view('patientregister');
                }
                // Attempt to insert the new user
                
            }
        } else {
            // Show the registration form
            $this->view('patientregister');
        }

        
    }
}
