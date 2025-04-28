<?php

class DrEditProfile
{
    use Controller;

    public function index()
    {
        $doctorId = $_SESSION['user']['user_id'];
        $doctorModel = new Doctor();
        $userModel = new User();
        $doctorUpdateModel = new Doctor_Profile_Update();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userData = [
                'firstName'     => htmlspecialchars(trim($_POST['firstName']), ENT_QUOTES, 'UTF-8'),
                'lastName'      => htmlspecialchars(trim($_POST['lastName']), ENT_QUOTES, 'UTF-8'),
                'address'       => htmlspecialchars(trim($_POST['address']), ENT_QUOTES, 'UTF-8'),
                'phoneNumber'   => trim($_POST['phoneNumber']),
            ];
        
            $errors = [];
        
            $photoPath = null;
            if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['profile_pic'];
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
                if (in_array($file['type'], $allowedTypes) && in_array($fileExtension, $allowedExtensions) && $file['size'] <= 2 * 1024 * 1024) {
                    $targetDir = __DIR__ . '/../../public/profile-Photos/';
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0755, true);
                    }
        
                    $fileName = 'doctor_' . $doctorId . '_' . uniqid() . '.' . $fileExtension;
                    $targetFile = $targetDir . $fileName;
        
                    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                        $photoPath = 'profile-Photos/' . $fileName;
                    } else {
                        $errors[] = 'Failed to upload profile picture.';
                    }
                } else {
                    $errors[] = 'Invalid profile picture type, extension, or size exceeds 2MB.';
                }
            }
        
            // === Certification Upload ===
            $certificationPath = null;
            if (isset($_FILES['certification_path']) && $_FILES['certification_path']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['certification_path']['tmp_name'];
                $fileName = $_FILES['certification_path']['name'];
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        
                $uploadDir =  __DIR__ . '/../../public/Certificate-images/';
                $newFileName = uniqid('cert_', true) . '.' . $fileExtension;
                $destination = $uploadDir . $newFileName;
        
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
        
                if (move_uploaded_file($fileTmpPath, $destination)) {
                    $certificationPath = 'Certificate-images/' . $newFileName;
                } else {
                    $errors[] = 'Failed to upload certification image.';
                }
            }
        
            $DoctorData = [
                'doctor_id'          => $doctorId,
                'description'        => htmlspecialchars(trim($_POST['description']), ENT_QUOTES, 'UTF-8'),
                'experience'         => htmlspecialchars(trim($_POST['experience']), ENT_QUOTES, 'UTF-8'),
                'photo_path'         => $photoPath,
                'certifications'     => htmlspecialchars(trim($_POST['certifications']), ENT_QUOTES, 'UTF-8'),
                'certification_path' => $certificationPath,
            ];
        
            // === Validation ===
            if (empty($DoctorData['description'])) {
                $errors[] = 'Description is required.';
            }
        
            if (!preg_match('/^[0-9]{10}$/', $userData['phoneNumber'])) {
                $errors[] = 'Invalid phone number.';
            }
            // var_dump($DoctorData);
            // exit();
        
            // === Save if valid ===
            if (empty($errors)) {
                $r1 = $userModel->update($doctorId, $userData, 'user_id');
                $r2 = $doctorUpdateModel->insert($DoctorData);
                if ($r1 && $r2) {
                    $_SESSION['success_message'] = 'Update Request Sent!';
                    redirect('drProfile');
                    exit;
                } else {
                    $_SESSION['success_message'] = 'Update Request Failed!';
                    redirect('drEditProfile');
                }
            } else {
                if ($photoPath) {
                    $userData['photo_path'] = $photoPath;
                }
                
                $this->view('drEditProfile', [
                    'doctorData' => $DoctorData,
                    'userData'   => $userData,
                    'error'      => implode('<br>', $errors),
                ]);
            }
        }
         else {
            $doctorData = $doctorModel->first(['doctor_id' => $doctorId]);
            $userData = $userModel->first(['user_id' => $doctorId]);
            $this->view('drEditProfile', ['doctorData' => $doctorData, 'userData' => $userData]);
        }
    }
}
