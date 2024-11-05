<?php

class PatientRegister {
    use Controller;

    public function index() {
        $user = new User;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['login'])) {
                // Login logic
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
                    'Password' => $_POST['Password'],
                    'Address' => $_POST['Address'] ?? '',
                    'Age' => $_POST['Age'] ?? ''
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
