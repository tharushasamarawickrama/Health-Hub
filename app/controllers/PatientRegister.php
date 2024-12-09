<?php

class PatientRegister {
    use Controller;

    public function index() {
        $data = [];
        // $data['login_id'] = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['login'])) {
                // $id = $_GET['id'];
                $user = new User;
                $arr['Email'] = $_POST['logEmail'] ?? '';
                $row = $user->first($arr);
                if(!$row){
                    $user->errors['Email'] = "Invalid Email or Password";
                    $data['errors'] = $user->errors;
                    $this->view('patientregister', $data);
                }else{
                    $userrole = $row['user_role'];
                    $data['userrole'] = $userrole;
                }
                

                

                switch($userrole){
                    case "patient":
                        
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('home'); // Redirect after successful login
                        } else {
                            $user->errors['Email'] = "Invalid Email or Password";
                            $data['errors'] = $user->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    case "doctor":
                        
                        if ($row && isset($row['Password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('drDashboard'); // Redirect after successful login
                        } else {
                            $user->errors['Email'] = "Invalid Email or Password";
                            $data['errors'] = $user->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    case "admin":
                       
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('AdminDashboard'); // Redirect after successful login
                        } else {
                            $user->errors['Email'] = "Invalid Email or Password";
                            $data['errors'] = $user->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    case "labassistant":
                       
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('labdashboard'); // Redirect after successful login
                        } else {
                            $user->errors['Email'] = "Invalid Email or Password";
                            $data['errors'] = $user->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    case "receptionist":
                        
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('ReDashboard'); // Redirect after successful login
                        } else {
                            $user->errors['Email'] = "Invalid Email or Password";
                            $data['errors'] = $user->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    case 'pharmacist':
                       
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('phdashboard'); // Redirect after successful login
                        } else {
                            $user->errors['Email'] = "Invalid Email or Password";
                            $data['errors'] = $user->errors;
                            $this->view('patientregister', $data);
                        }
                        break;            
                }
                // Login logic
                // $arr['NIC'] = $_POST['logNIC'] ?? '';
                // $row = $user->first($arr);

                // if ($row && isset($row['Password']) && $row['Password'] == $_POST['logPassword']) {
                //     $_SESSION['user'] = $row;
                //     redirect('searchappoinment'); // Redirect after successful login
                // } else {
                //     $user->errors['Email'] = "Invalid NIC or Password";
                //     $data['errors'] = $user->errors;
                //     $this->view('patientregister', $data);
                // }
            } else {
                // Registration logic
                $user = new User;
                $patient = new Patient;
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
                    'Age' => $_POST['Age'] ?? '',
                    'user_role' => 'patient'

                    
                ];

                $arr['Email'] = $_POST['Email'] ?? '';
                $row = $user->first($arr);

                if ($row) {
                    $user->errors['Email'] = "Email already exists, please login";
                    $data['errors'] = $user->errors;
                } else {
                    $user->insert($data);
                    $login = $user->first($arr);
                    // show($login);
                    // show($patient);
                    $patientData = ['user_id' => $login['user_id']];
                    
                    $patient->insert($patientData);
                    // show($patient);
                    $data['registration_success'] = true; // Set the success flag
                }

                $this->view('patientregister', $data);
                // redirect('patientregister?id=1');
            }
        } else {
              
            $this->view('patientregister', $data);
        }
    }
}
