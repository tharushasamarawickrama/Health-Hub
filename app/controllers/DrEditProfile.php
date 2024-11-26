<?php

    class DrEditProfile
    {
    use Controller;

    public function index() {
        $doctorId = 5; // Hardcoded doctor ID (can be dynamic based on session/login)
            require_once "../app/models/Doctor.php";
            $doctorModel = new Doctor();
            $doctorData = $doctorModel->first(['doctor_id' => $doctorId]);
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'firstName'    => htmlspecialchars(trim($_POST['firstName']), ENT_QUOTES, 'UTF-8'),
                    'lastName'     => htmlspecialchars(trim($_POST['lastName']), ENT_QUOTES, 'UTF-8'),
                    'description'    => htmlspecialchars(trim($_POST['description']), ENT_QUOTES, 'UTF-8'),
                    'experience'     => htmlspecialchars(trim($_POST['experience']), ENT_QUOTES, 'UTF-8'),
                    'specialties'    => htmlspecialchars(trim($_POST['specialties']), ENT_QUOTES, 'UTF-8'),
                    'certifications' => htmlspecialchars(trim($_POST['certifications']), ENT_QUOTES, 'UTF-8'),
                    'phoneNumber'    => trim($_POST['phoneNumber']),
                    'email'          => trim($_POST['email']),
                ];
        
                $errors = [];
                if (empty($data['description'])) {
                    $errors[] = 'Description is required.';
                }
        
                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors[] = 'Invalid email address.';
                }
        
                if (!preg_match('/^[0-9]{10}$/', $data['phoneNumber'])) {
                    $errors[] = 'Invalid phone number.';
                }
        
                if (empty($errors)) {
                    if ($doctorModel->update($doctorId, $data, 'doctor_id')) {
                        $_SESSION['success_message'] = 'Profile updated successfully!';
                        redirect('drProfile');
                        exit;
                    } else {
                        $this->view('drProfile', [
                            'doctorData' => $data,
                            'error'      => 'Failed to update profile. Please try again.',
                        ]);
                    }
                } else {
                    $this->view('drEditProfile', [
                        'doctorData' => $data,
                        'error'      => implode('<br>', $errors),
                    ]);
                }
            } else {
                $doctorData = $doctorModel->first(['doctor_id' => $doctorId]);
                $this->view('drEditProfile', ['doctorData' => $doctorData]);
            }
        }
}
