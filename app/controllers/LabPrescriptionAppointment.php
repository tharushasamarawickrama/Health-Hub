<?php
class LabPrescriptionAppointment {
    use Controller;
    private $labAssistantModel;

    public function index() {
        $labAssistant = new LabAssistant();
        
        // Check if id exists in GET parameters
        $appointmentId = isset($_GET['id']) ? $_GET['id'] : null;
        
        if ($appointmentId) {
            $appointmentDetails = $labAssistant->getAppointmentDetails($appointmentId);
            $data['appointment_details'] = $appointmentDetails;
        } else {
            // Handle case when no ID is provided
            $data['appointment_details'] = null;
        }
        
        $this->view('labprescriptionappointment', $data);
    }
}
