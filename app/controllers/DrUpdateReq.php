<?php

class DrUpdateReq {
    use Controller;

    public function index() {
        $id = $_GET['id'];
        $dr_upd_req = new Doctor_Profile_Update;

        $arr['doctor_id'] = $id;
        $data = $dr_upd_req->first($arr);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Collect data from the form
            $userData = [
                'user_id' => $data['doctor_id'] ?? '',
                'firstName' => $_POST['firstName'] ?? '',
                'lastName' => $_POST['lastName'] ?? '',
                'photo_path' => $data['photo_path'] ?? '',
            ];

            $doctorData = [
                'doctor_id' => $data['doctor_id'] ?? '',
                'description' => $_POST['description'] ?? '',
                'experience' => $_POST['experience'] ?? '',
                'certifications' => $_POST['certifications'] ?? '',
            ];

            // Update the `users` table
            $user = new User;
            $userResult = $user->UserUpdateByAdmin($userData['user_id'], $userData, 'user_id');

            // Update the `doctors` table
            $doctor = new Doctor;
            $doctorResult = $doctor->DoctorUpdateByAdmin($doctorData['doctor_id'], $doctorData, 'doctor_id');

            if ($userResult && $doctorResult) {
                redirect('DrProfileUpdate'); // Redirect to the request list after successful update
            } else {
                echo "Failed to update doctor details.";
            }
        }

        if ($data) {
            $this->view('DrUpdateReq', $data);
        }
    }
}
?>