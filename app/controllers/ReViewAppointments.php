<?php

class ReViewAppointments  {
    use Controller;
    private $ReceptionistModel;

    public function __construct() {
        $this->ReceptionistModel = new Receptionist();
    }

    public function index($appointment_id = null) {
        if ($appointment_id === null && isset($_GET['appointment_id'])) {
            $appointment_id = $_GET['appointment_id'];
        }
    
       
        $appointments = $this->ReceptionistModel->getappointmentsbyreceptionist($appointment_id);
        
        $groupedAppointments = [];
        if (is_array($appointments) || is_object($appointments)) {
            foreach ($appointments as $appointment) {
                $id = $appointment['appointment_id'];
    
                if (!isset($groupedAppointments[$id])) {
                    $groupedAppointments[$id] = [
                        'appointment_id' => $appointment['appointment_id'],
                        'nic' => $appointment['nic'],
                        'created_at' => $appointment['created_at']
                    ];
                }
            }
        }
        $data = [
            'appointments' => array_values($groupedAppointments) // reindexing the array
        ];
       
        // Pass the grouped appointments to the view
        $this->view('reviewappointments', $data);
    
    }
}