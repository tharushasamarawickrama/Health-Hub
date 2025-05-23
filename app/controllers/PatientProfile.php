<?php

class PatientProfile
{
    use Controller;
    public function index()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteProfile'])) {
            $user = new User;
            $id = $_SESSION['user']['id'];
            echo $id;
            $user->delete($id);
            session_destroy();
            redirect('patientregister');
        }
        $UpdatePatient = new User;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveupdate'])) {
            $data = [
                'title' => $_POST['title'],
                'firstName' => $_POST['firstName'],
                'lastName' => $_POST['lastName'],
                'email' => $_POST['email'],
                'phoneNumber' => $_POST['phoneNumber'],
                'nic' => $_POST['nic'],
                // 'Gender' => $_POST['gender'],
                // 'Age' => $_POST['age'],
                'address' => $_POST['address'],
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
                    $this->view('patientprofile', $data);
                    return;
                }

                // Check if the file is a valid image
                if (getimagesize($_FILES['ProfilePic']['tmp_name']) === false) {
                    $_SESSION['error'] = "The selected file is not a valid image.";
                    $this->view('patientprofile', $data);
                    return;
                }

                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES['ProfilePic']['tmp_name'], $target_file)) {
                    $data['photo_path'] = $target_file; // Add the file path to the $data array
                } else {
                    $_SESSION['error'] = "Failed to upload the profile picture.";
                    $this->view('patientprofile', $data);
                    return;
                }
            }

            // Get user ID from session and update data
            $id = $_SESSION['user']['user_id'];
            $arr['user_id'] = $id;
            echo $id;
            if ($UpdatePatient->update($id, $data, 'user_id')) {
                $arr['user_id'] = $id;
                $updateduser = $UpdatePatient->first($arr);
                $_SESSION['user'] = $updateduser;
                $_SESSION['success'] = "Profile updated successfully.";
                redirect('patientprofile');
            } else {
                $_SESSION['error'] = "Failed to update profile.";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['resetButton'])) {
            $data = [
                'user_role' => 'disabled',
            ];
            show($data);
            $id = $_SESSION['user']['user_id'];
            if ($UpdatePatient->update($id, $data, 'user_id')) {
                $arr['user_id'] = $id;
                $updateduser = $UpdatePatient->first($arr);
                if($updateduser['user_role'] == 'disabled'){
                    $appointment = new Appointment;
                    $arr2['patient_id'] = $id;
                    $disabledata = $appointment->getAppointmentsByUserId($arr2['patient_id']);
                    // show($disabledata);
                    foreach($disabledata as $appo){
                        // show($appo);
                        $arr3['appointment_id'] = $appo['appointment_id'];
                        $appointment->delete($appo['appointment_id'], 'appointment_id');
                        $prescription = new Prescription;
                        $arr4['prescription_id'] = $appo['prescription_id'];
                        $prescription->delete($appo['prescription_id'], 'prescription_id');
                        $appointmentlabtest = new Appointment_LabTest;
                        $arr5['appointment_id'] = $appo['appointment_id'];
                        $appointmentlabtest->delete($appo['appointment_id'], 'appointment_id');
                        
                    }
                    $patientreferal = new Patient_Referal;
                    $arr6['user_id'] = $id;
                    
                    $patientreferal->delete1($id, 'user_id');
                    $patient = new Patient;
                    $arr7['patient_id'] = $id;
                    $patient->delete($id, 'patient_id');
                }
                $_SESSION['user'] = $updateduser;
                $_SESSION['success'] = "Profile Reset successfully.";
                redirect('patientregister');
            } else {
                $_SESSION['error'] = "Failed to Reset profile.";
            }
        }
        if (isset($_GET['action']) && $_GET['action'] === 'logout') {
            // Unset all of the session variables
            unset($_SESSION['user']);
            unset($_SESSION['appointment_date']);
            // Destroy the session
            session_destroy();

            // Redirect to the login page or homepage
            // header("Location: " . URLROOT . "/Prevlog");
            redirect('/patientregister');
        }

        // Reload the view with errors if any
        $this->view('patientprofile');
    }
}
