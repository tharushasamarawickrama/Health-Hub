<?php
class LabPrescriptionAppointment {
    use Controller;
    private $labAssistantModel;

    public function __construct() {
        $this->labAssistantModel = new LabAssistant();
    }

    public function index($appointment_id = '') {
        if(empty($appointment_id)) {
            redirect('labprescriptions');
            return;
        }
        
        $prescriptionDetails = $this->labAssistantModel->getLabPrescriptionDetails($appointment_id);
        
        if(empty($prescriptionDetails)) {
            redirect('labprescriptions');
            return;
        }
        
        $data['prescription'] = $prescriptionDetails[0];
        $this->view('labprescriptionappointment', $data);
    }
}
