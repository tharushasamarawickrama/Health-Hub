<?php

class EditPatientProfile
{
    use Controller;

    public function index()
    {
        $UpdatePatient = new User;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'Title' => $_POST['Title'],
                'FirstName' => $_POST['FirstName'],
                'LastName' => $_POST['LastName'],
                'Email' => $_POST['Email'],
                'PhoneNumber' => $_POST['PhoneNumber'],
                'NIC' => $_POST['NIC'],
                'Gender' => $_POST['Gender'],
                'Age' => $_POST['Age'],
                'Address' => $_POST['Address'],
            ];

            // Handle profile image upload
            if (isset($_FILES['ProfilePic']) && $_FILES['ProfilePic']['error'] == 0) {
                $target_dir = "profile-images/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
                }

                $file_name = basename($_FILES['ProfilePic']['name']);
                $target_file = $target_dir . uniqid() . "_" . $file_name;

                // Validate image type
                $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                if (!in_array($file_type, $allowed_types)) {
                    $_SESSION['error'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                    $this->view('editpatientprofile', $data);
                    return;
                }

                // Check if the file is a valid image
                if (getimagesize($_FILES['ProfilePic']['tmp_name']) === false) {
                    $_SESSION['error'] = "The selected file is not a valid image.";
                    $this->view('editpatientprofile', $data);
                    return;
                }

                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES['ProfilePic']['tmp_name'], $target_file)) {
                    $data['photo_path'] = $target_file; // Add the file path to the $data array
                } else {
                    $_SESSION['error'] = "Failed to upload the profile picture.";
                    $this->view('editpatientprofile', $data);
                    return;
                }
            }

            // Get user ID from session and update data
            $id = $_SESSION['user']['user_id'];
            if ($UpdatePatient->update($id, $data,'user_id')) {
                $arr['user_id']=$id;
                $updateduser = $UpdatePatient->first($arr);
                $_SESSION['user'] = $updateduser;
                $_SESSION['success'] = "Profile updated successfully.";
                redirect('patientprofile');
            } else {
                $_SESSION['error'] = "Failed to update profile.";
            }
        }

        // Reload the view with errors if any
        $this->view('editpatientprofile');
    }
}
