<?php

class PatientRegister {
    use Controller;

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['login'])) {
                $id = $_GET['id'];

                switch($id){
                    case 1:
                        $user = new User;
                        $arr['NIC'] = $_POST['logNIC'] ?? '';
                        $row = $user->first($arr);
                        
                        if ($row && isset($row['Password']) && $row['Password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('searchappoinment'); // Redirect after successful login
                        } else {
                            $user->errors['Email'] = "Invalid NIC or Password";
                            $data['errors'] = $user->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    case 2:
                        $doctor = new Doctor;
                        $arr['nic'] = $_POST['logNIC'] ?? '';
                        $row = $doctor->first($arr);
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('drDashboard'); // Redirect after successful login
                        } else {
                            $doctor->errors['Email'] = "Invalid NIC or Password";
                            $data['errors'] = $doctor->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    case 3:
                        $admin = new Admin;
                        $arr['nic'] = $_POST['logNIC'] ?? '';
                        $row = $admin->first($arr);
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('AdminDashboard'); // Redirect after successful login
                        } else {
                            $admin->errors['Email'] = "Invalid NIC or Password";
                            $data['errors'] = $admin->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    case 4:
                        $lab = new LabAssistant;
                        $arr['nic'] = $_POST['logNIC'] ?? '';
                        $row = $lab->first($arr);
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('labdashboard'); // Redirect after successful login
                        } else {
                            $lab->errors['Email'] = "Invalid NIC or Password";
                            $data['errors'] = $lab->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    case 5:
                        $receptionist = new Receptionist;
                        $arr['nic'] = $_POST['logNIC'] ?? '';
                        $row = $receptionist->first($arr);
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('searchappoinment'); // Redirect after successful login
                        } else {
                            $receptionist->errors['Email'] = "Invalid NIC or Password";
                            $data['errors'] = $receptionist->errors;
                            $this->view('patientregister', $data);
                        }
                        break;
                    case 6:
                        $pharmacist = new Pharmacist;
                        $arr['nic'] = $_POST['logNIC'] ?? '';
                        $row = $pharmacist->first($arr);
                        if ($row && isset($row['password']) && $row['password'] == $_POST['logPassword']) {
                            $_SESSION['user'] = $row;
                            redirect('phdashboard'); // Redirect after successful login
                        } else {
                            $pharmacist->errors['Email'] = "Invalid NIC or Password";
                            $data['errors'] = $pharmacist->errors;
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
                    
                ];

                $arr['NIC'] = $_POST['NIC'] ?? '';
                $row = $user->first($arr);

                if ($row) {
                    $user->errors['NIC'] = "NIC already exists, please login";
                    $data['errors'] = $user->errors;
                } else {
                    $user->insert($data);
                    $data['registration_success'] = true; // Set the success flag
                }

                $this->view('patientregister', $data);
            }
        } else {
            $this->view('patientregister');
        }
    }
}
