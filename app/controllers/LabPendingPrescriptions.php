<?php
    class LabPendingPrescriptions {
        use Controller;
        private $labAssistantModel;
    
        public function __construct() {
            $this->labAssistantModel = new LabAssistant();
        }
    
        public function index($appointment_id = null) {
            if ($appointment_id === null && isset($_GET['appointment_id'])) {
                $appointment_id = $_GET['appointment_id'];
            }
    
            // Get all pending lab appointments (each row has one lab test)
            $pendingAppointments = $this->labAssistantModel->getPendingLabAppointments($appointment_id);
    
            // Group by appointment_id
            $groupedAppointments = [];
            if (is_array($pendingAppointments) || is_object($pendingAppointments)) {

            foreach ($pendingAppointments as $appointment) {
                $id = $appointment['appointment_id'];
    
                if (!isset($groupedAppointments[$id])) {
                    $groupedAppointments[$id] = [
                        'appointment_id' => $appointment['appointment_id'],
                        'nic' => $appointment['nic'],
                        'labtests' => [],
                    ];
                }
    
                $groupedAppointments[$id]['labtests'][] = $appointment['labtest_name'];
            }
        }
            $data = [
                'appointments' => array_values($groupedAppointments) // reindexing the array
            ];
    
            $this->view('labpendingprescriptions', $data);
        }
    }
    


    