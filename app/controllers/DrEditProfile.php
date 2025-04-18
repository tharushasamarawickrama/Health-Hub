<?php

class DrEditProfile
{
    use Controller;

    public function index()
    {
        $doctorId = $_SESSION['user']['user_id'];
        $doctorModel = new Doctor();
        $userModel = new User();
        $userData = $userModel->first(['user_id' => $doctorId]);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userData = [
                'firstName'    => htmlspecialchars(trim($_POST['firstName']), ENT_QUOTES, 'UTF-8'),
                'lastName'     => htmlspecialchars(trim($_POST['lastName']), ENT_QUOTES, 'UTF-8'),
                'phoneNumber'    => trim($_POST['phoneNumber']),
                'email'          => trim($_POST['email']),
                'photo_path' => $userData['photo_path']
            ];
            $DoctorData = [
                'description'    => htmlspecialchars(trim($_POST['description']), ENT_QUOTES, 'UTF-8'),
                'experience'     => htmlspecialchars(trim($_POST['experience']), ENT_QUOTES, 'UTF-8'),
                'specialization'    => htmlspecialchars(trim($_POST['specialization']), ENT_QUOTES, 'UTF-8'),
                'certifications' => htmlspecialchars(trim($_POST['certifications']), ENT_QUOTES, 'UTF-8'),
            ];

            $errors = [];
            if (empty($DoctorData['description'])) {
                $errors[] = 'Description is required.';
            }

            if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Invalid email address.';
            }

            if (!preg_match('/^[0-9]{10}$/', $userData['phoneNumber'])) {
                $errors[] = 'Invalid phone number.';
            }

            if (empty($errors)) {
                if ($doctorModel->update($doctorId, $DoctorData, 'doctor_id') && $userModel->update($doctorId, $userData, 'user_id')) {
                    $_SESSION['success_message'] = 'Profile updated successfully!';
                    redirect('drProfile');
                    exit;
                } else {
                    $this->view('drProfile', [
                        'doctorData' => $DoctorData,
                        'userData' => $userData,
                        'error'      => 'Failed to update profile. Please try again.',
                    ]);
                }
            } else {
                $this->view('drEditProfile', [
                    'doctorData' => $DoctorData,
                    'userData' => $userData,
                    'error'      => implode('<br>', $errors),
                ]);
            }
        } else {
            $doctorData = $doctorModel->first(['doctor_id' => $doctorId]);
            $userData = $userModel->first(['user_id' => $doctorId]);
            $this->view('drEditProfile', ['doctorData' => $doctorData, 'userData' => $userData]);
        }
    }
}
