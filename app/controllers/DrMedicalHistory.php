<?php

class DrMedicalHistory {
    use Controller;

    public function index() {
        // Fetch the patient data (including medical history)
        $appointmentId = $_GET['appointment_id'];

        $appointmentModel = new Appointment();

        // Get patient ID
        $patientData = $appointmentModel->getPatientByAppointmentId($appointmentId);
        $patientId = $patientData ? $patientData[0]['patient_id'] : null;

        $patientModel = new Patient();
        $history = $patientId ? $patientModel->getMedicalHistoryByPatientId($patientId) : [];
        // echo "<pre>";
        // echo "Categorized Lab Tests:\n";
        // print_r($history);
        // echo "</pre>";
        // exit;

        // Fetch last appointment details
        $lastAppointmentData = [];
        if ($patientId) {
            $lastAppointmentRecord = $appointmentModel->getLastAppointment($_SESSION['user']['user_id'], $patientId);
            if (!empty($lastAppointmentRecord)) {
                $lastAppointmentId = $lastAppointmentRecord[0]['appointment_id'];
                $lastAppointment = $appointmentModel->getAppointmentById($lastAppointmentId);

                if ($lastAppointment) {
                    $prescriptionModel = new Prescription();
                    $diagnosis = $prescriptionModel->first(['prescription_id' => $lastAppointment['prescription_id']])['diagnosis'] ?? 'No diagnosis available';

                    $medicationModel = new Prescribed_Medications();
                    $medications = $medicationModel->findWhere(['prescription_id' => $lastAppointment['prescription_id']]) ?? [];

                    $lastAppointmentData = [
                        'appointment_date' => $lastAppointment['appointment_date'] ?? 'No appointment date available',
                        'diagnosis' => $diagnosis,
                        'medications' => $medications
                    ];
                }
            }
        }

        if (empty($lastAppointmentData)) {
            $lastAppointmentData = [];
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $updatedHistory = [];
        
            // Build arrays from keys and values
            foreach (['allergies', 'chronic_conditions', 'surgeries', 'immunizations', 'family_medical_history'] as $section) {
                $keys = $_POST["{$section}_keys"] ?? [];
                $values = $_POST["{$section}_values"] ?? [];
                $updatedHistory[$section] = array_combine($keys, $values);
            }
        
            
        
            $blah = $this->saveMedicalHistory($patientId, $updatedHistory);

            // Debug the results
            echo "<pre>";
            echo "Updated History:\n";
            print_r($blah);
            echo "</pre>";
            exit;
            $history = $updatedHistory; // Update the history in view after saving
        }
        

        // Pass data to the view
        $this->view('drMedicalHistory', [
            'history' => $history,
            'lastAppointmentData' => $lastAppointmentData,
            'appointmentId' => $appointmentId,
        ]);
    }

    private function saveMedicalHistory($patientId, $updatedHistory) {
        return json_encode($updatedHistory);
    }
}
