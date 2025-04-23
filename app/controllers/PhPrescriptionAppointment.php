<?php
    class PhPrescriptionAppointment {
        use Controller;
        private $pharmacistModel;
    
        public function __construct() {
            $this->pharmacistModel = new Pharmacist();
        }
    
        public function index() {
            if (!isset($_GET['appointment_id'])) {
                die("Error: No appointment ID provided.");
            }
    
            $appointment_id = $_GET['appointment_id'];
            $appointmentDetails = $this->pharmacistModel->getPrescriptionDetails($appointment_id);
    
            if (!$appointmentDetails) {
                $appointmentDetails = []; // Prevent errors if no data is found
            }
    
            // Pass data to view
            $this->view('phprescriptionappointment', [
                'appointment_id' => $appointment_id,
                'nic' => $appointmentDetails[0]['nic'] ?? 'N/A' ,
                'age' => $appointmentDetails[0]['age'] ?? 'N/A',
                'gender' => $appointmentDetails[0]['gender'] ?? 'N/A',
                'appointment_date' => $appointmentDetails[0]['appointment_date'] ?? 'N/A',
                'medications' => $appointmentDetails ,
                'doctor_id' => $appointmentDetails[0]['doctor_id'] ?? 'N/A',
                'doctor_name' => $appointmentDetails[0]['doctor_name'] ?? 'N/A',
            ]);
        }
        public function markCompleted() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $appointment_id = $_POST['appointment_id'];
                $this->pharmacistModel->updateAppointmentStatus($appointment_id, 'Completed');
    
                redirect('phdashboard');
            }
        }
        
        public function issuedMedication() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $medications = $_POST['medications'];
                $appointment_id = $_POST['appointment_id'];
    
                $noofunits = [];
    
                foreach ($medications as $index => $medication) {
                    $medication_name = trim($medication['name']); // Trim whitespace
                    $issuedDays = $medication['preferred_duration'];
                    $sigCode = $medication['sig_codes'];
                    $measurement = $medication['measurement'];
                    $quantityPrescribed = $medication['quantity'];
    
                    // Fetch medication quantity from medications table
                    $medicationsModel = new Medications();
                    $medicationDetails = $medicationsModel->getMedicationDetails($medication_name);
    
                    if ($medicationDetails && isset($medicationDetails[0]['quantity'])) {
                        $quantityPerUnit = (int) $medicationDetails[0]['quantity'];
                    } else {
                        $quantityPerUnit = 1; // Fallback
                    }
                    // Get frequency per day from sig code
                    $sigCodeModel = new Sig_codes();
                    $sigDetails = $sigCodeModel->getFrequencyBySigCode($sigCode);
                    $frequencyPerDay = isset($sigDetails[0]['frequencyperday']) ? (int) $sigDetails[0]['frequencyperday'] : 1;
    
                    // Final calculation
                    $amount = ($frequencyPerDay * $issuedDays * $quantityPrescribed) / $quantityPerUnit;
                    $noofunits[$index] = [
                        'name' => $medication_name,
                        'amount' => ceil($amount)
                    ];
                }
    
                // Get full appointment data for the view
                $appointmentDetails = $this->pharmacistModel->getPrescriptionDetails($appointment_id);
                
                foreach ($appointmentDetails as $i => &$med) {
                    if (isset($medications[$i]['preferred_duration'])) {
                        $med['preferred_duration'] = $medications[$i]['preferred_duration'];
                    }
                }
                
                $this->view('phprescriptionappointment', [
                    'noofunits' => $noofunits,
                    'appointment_id' => $appointment_id,
                    'nic' => $appointmentDetails[0]['nic'] ?? 'N/A',
                    'age' => $appointmentDetails[0]['age'] ?? 'N/A',
                    'gender' => $appointmentDetails[0]['gender'] ?? 'N/A',
                    'appointment_date' => $appointmentDetails[0]['appointment_date'] ?? 'N/A',
                    'medications' => $appointmentDetails,
                    'doctor_id' => $appointmentDetails[0]['doctor_id'] ?? 'N/A',
                    'doctor_name' => $appointmentDetails[0]['doctor_name'] ?? 'N/A',
                ]);
            }
        }
        
    }
    
