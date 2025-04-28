<?php

class DrRequest {
    use Controller;

    public function index() {
        $dr_request = new dr_request;
        $user = new User;
        $doctor = new Doctor;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => 'Dr',
                'firstName' => $_POST['firstName'] ?? '',
                'lastName' => $_POST['lastName'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phoneNumber' => $_POST['phoneNumber'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'dob' => $_POST['dob'] ?? '',
                'nic' => $_POST['nic'] ?? '',
                'address' => $_POST['address'] ?? '',
                'age' => null,
                'photo_path' => '',
                'user_role' => 'doctor',
                'slmc_photo' => '',
                'slmcNo' => $_POST['slmcNo'] ?? '',
                'experience' => $_POST['experience'] ?? '',
                'specialization' => $_POST['specialization'] ?? '',
                'certifications' => $_POST['certifications'] ?? '',
                'description' => $_POST['description'] ?? '',
                'type' => $_POST['type'] ?? '',
            ];

            if ($user->emailExists($data['email']) || $dr_request->emailExists($data['email'])) {
                $data['error'] = "The email address is already in use. Please use a different email.";
                $this->view('DrRequest', $data);
                return;
            }

            if ($user->nicExists($data['nic']) || $dr_request->nicExists($data['nic'])) {
                $data['error'] = "The NIC is already in use. Please use a different NIC.";
                $this->view('DrRequest', $data);
                return;
            }

            if ($dr_request->slmcExists($data['slmcNo']) || $doctor->slmcExists($data['slmcNo'])) {
                $data['error'] = "The SLMC number is already in use. Please use a different SLMC number.";
                $this->view('DrRequest', $data);
                return;
            }


            if ($data['specialization'] === 'None' && $data['type'] !== 'opd') {
                $data['error'] = "If specialization is 'None', Doctor's Type must be 'OPD'.";
                $this->view('DrRequest', $data);
                return;
            }

            if ($data['specialization'] !== 'None' && $data['type'] !== 'specialist') {
                $data['error'] = "If specialization is selected, Doctor's Type must be 'Specialist'.";
                $this->view('DrRequest', $data);
                return;
            }

            if (!empty($data['dob'])) {
                $dob = new DateTime($data['dob']);
                $today = new DateTime();
                $data['age'] = $today->diff($dob)->y;
            }

            if (isset($_FILES['photo_path'])) {
                $target_dir = "profile-images/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $file_name = basename($_FILES['photo_path']['name']);
                $target_file = $target_dir . uniqid() . '_' . $file_name;

                $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                if (!in_array($file_type, $allowed_types) || getimagesize($_FILES['photo_path']['tmp_name']) === false) {
                    $this->view('DrRequest', $data);
                    return;
                }
                if (move_uploaded_file($_FILES['photo_path']['tmp_name'], $target_file)) {
                    $data['photo_path'] = $target_file;
                } else {
                    $this->view('DrRequest', $data);
                    return;
                }
            }

            if (isset($_FILES['slmc_photo'])) {
                $target_dir = "Certificate-images/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $file_name = basename($_FILES['slmc_photo']['name']);
                $target_file = $target_dir . uniqid() . '_' . $file_name;

                $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                if (!in_array($file_type, $allowed_types) || getimagesize($_FILES['slmc_photo']['tmp_name']) === false) {
                    $this->view('DrRequest', $data);
                    return;
                }
                if (move_uploaded_file($_FILES['slmc_photo']['tmp_name'], $target_file)) {
                    $data['slmc_photo'] = $target_file;
                } else {
                    $this->view('DrRequest', $data);
                    return;
                }
            }

            $dr_req_id = $dr_request->insert($data);
            if ($dr_req_id) {
                $data['success'] = "Request submitted successfully!";
            } else {
                $data['error'] = "Failed to submit request!";
            }

            $this->view('DrRequest', $data);
            redirect('DrRequest');
            return;
        }

        $this->view('DrRequest');
    }
}
?>