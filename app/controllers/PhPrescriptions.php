<?php
class PhPrescriptions {
    use Controller;
    private $pharmacistModel;

    public function __construct() {
        $this->pharmacistModel = new Pharmacist();
    }
    
    public function index() {
        $appointments = $this->pharmacistModel->getPhAppointments();
            $data = [
                'appointments' => $appointments
            ];
            
            $this->view('phprescriptions', $data);
        }
    

    public function search() {
        $input = json_decode(file_get_contents("php://input"), true);
    
        if (isset($input['appointment_id'])) {
            $appointmentId = $input['appointment_id'];
            $appointments = $this->pharmacistModel->searchPhAppointments($appointmentId);
    
            echo json_encode(['appointments' => $appointments]);
            return;
        }
    
        echo json_encode(['appointments' => []]);
    }
}