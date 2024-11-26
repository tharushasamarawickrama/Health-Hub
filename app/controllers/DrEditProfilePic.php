<?php

class DrEditProfilePic {
    use Controller;
    private $doctorId = 5;

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_pic'])) {
            $file = $_FILES['profile_pic'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $errors = '';
    
            if (in_array($file['type'], $allowedTypes) && in_array($fileExtension, $allowedExtensions) && $file['size'] <= 2 * 1024 * 1024) {
                $targetDir = __DIR__ . '/../../public/assets/uploads/';
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
    
                $fileName = 'doctor_' . $this->doctorId . '_' . uniqid() . '.' . $fileExtension;
                $targetFile = $targetDir . $fileName;
    
                if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                    require_once "../app/models/Doctor.php";
                    $doctorModel = new Doctor();
    
                    if ($doctorModel->update($this->doctorId, ['profile_pic' => $fileName], 'doctor_id')) {
                        $this->view('drEditProfile', [
                            'success'    => 'Profile picture updated successfully!',
                            'doctorData' => $this->getDoctorData($this->doctorId),
                        ]);
                    } else {
                        $errors = 'Database update failed. Please try again.';
                    }
                } else {
                    $errors = 'Failed to upload profile picture.';
                }
            } else {
                $errors = 'Invalid file type, extension, or size exceeds limit.';
            }
    
            if ($errors) {
                $this->view('drEditProfile', [
                    'doctorData' => $this->getDoctorData($this->doctorId),
                    'error'      => $errors,
                ]);
            }
        } else {
            redirect('drEditProfile');
        }
    }
    

    private function getDoctorData($doctorId) {
        require_once "../app/models/Doctor.php";
        $doctorModel = new Doctor();
        return $doctorModel->first(['doctor_id' => $doctorId]);
    }
}