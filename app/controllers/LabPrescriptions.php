<?php
class LabPrescriptions {
    use Controller;
    private $labAssistantModel;

    public function __construct() {
        $this->labAssistantModel = new LabAssistant();
    }

    public function index() {
        $appointments = $this->labAssistantModel->getLabAppointments();
        
        $data = [
            'appointments' => $appointments
        ];
        
        $this->view('labprescriptions', $data);
    }
/*
    public function search(){
        $appointmentId = $_POST['appointment_id'] ?? null;
        $appointments = $this -> labAssistantModel -> searchLabAppointments($appointmentId);
        $data = [
            'appointments' => $appointments 
        ];
        $this -> view('labprescriptions',$data);
    }
    
    public function search($id) {
        $appointments = $this->labPrescriptionModel->searchAppointments($id);
        header('Content-Type: application/json');
        echo json_encode($appointments);
    }*/

    public function search() {
    $input = json_decode(file_get_contents("php://input"), true);

    if (isset($input['appointment_id'])) {
        $appointmentId = $input['appointment_id'];
        $appointments = $this->labAssistantModel->searchLabAppointments($appointmentId);

        echo json_encode(['appointments' => $appointments]);
        return;
    }

    echo json_encode(['appointments' => []]);
}

}

