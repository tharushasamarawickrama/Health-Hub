<?php

class DrProfile {
    use Controller;

    private $doctorId = 123; // Hardcoded doctor ID

    public function index() {
        $doctorData = $this->getDoctorData($this->doctorId);
        $this->view('drProfile', ['doctorData' => $doctorData]);
    }

    public function update() {
        // Handle AJAX request to update doctor data
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || !isset($data['id'])) {
            echo json_encode(["success" => false, "message" => "Invalid input."]);
            return;
        }

        require_once "../app/models/Doctor.php";
        $doctorModel = new Doctor();
        $success = $doctorModel->update($data['id'], $data);

        if ($success) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update profile."]);
        }
    }

    private function getDoctorData($doctorId) {
        require_once "../app/models/Doctor.php";
        $doctorModel = new Doctor();
        return $doctorModel->first(['id' => $doctorId]);
    }
}
