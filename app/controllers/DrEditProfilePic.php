<?php

class DrEditProfilePic
{
    use Controller;

    public function index()
    {

        $doctorId = $_SESSION['user']['user_id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_pic'])) {
            $file = $_FILES['profile_pic'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $errors = '';

            if (in_array($file['type'], $allowedTypes) && in_array($fileExtension, $allowedExtensions) && $file['size'] <= 2 * 1024 * 1024) {
                $targetDir = __DIR__ . '/../../public/assets/profile-images/';
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                $fileName = 'doctor_' . $doctorId . '_' . uniqid() . '.' . $fileExtension;
                $targetFile = $targetDir . $fileName;

                if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                    $userModel = new User();
                    $doctorModel = new Doctor();
                    $userData =  $userModel->first(['user_id' => $doctorId]);
                    $doctorData =  $doctorModel->first(['doctor_id' => $doctorId]);
                    $this->view('drProfile', ['doctorData' => $doctorData, 'userData' => $userData, 'photo_path' => 'profile-images/' . $fileName]);
                } else {
                    $errors = 'Failed to upload profile picture.';
                }
            } else {
                $errors = 'Invalid file type, extension, or size exceeds limit.';
            }

            if ($errors) {
                $_SESSION['error'] = $errors;
                redirect('drEditProfile');
            }
        } else {
            redirect('drEditProfile');
        }
    }



    private function getDoctorData($doctorId)
    {
        require_once "../app/models/Doctor.php";
        $doctorModel = new Doctor();
        return $doctorModel->first(['doctor_id' => $doctorId]);
    }
}
