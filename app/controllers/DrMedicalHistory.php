<?php

class DrMedicalHistory {
    use Controller;

    public function index() {
        if (isset($_SESSION['success_message'])) {
            echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
            unset($_SESSION['success_message']);
        }
        // Fetch the patient data (including medical history)
        $appointmentId = $_GET['appointment_id'];

        $appointmentModel = new Appointment();

        // Get patient ID
        $appointmentData = $appointmentModel->getPatientAndDateByAppointmentId($appointmentId);
        $patientId = $appointmentData ? $appointmentData[0]['patient_id'] : null;

        $patientModel = new Patient();
        $fetchedHistory = $patientModel->getMedicalHistoryByPatientId($patientId);
        $formattedHistory = $fetchedHistory ? json_decode($fetchedHistory[0]['medical_history'], true) : [];

        // Fetch prev appointment details
        $prevAppointmentData = [];
        $appointmentDate = $appointmentData ? $appointmentData[0]['appointment_date'] : null;
        if ($patientId) {
            $prevAppointment = $appointmentModel->getPrevAppointment($_SESSION['user']['user_id'], $patientId, $appointmentDate);
            if (!empty($prevAppointment)) {
                    $prescriptionModel = new Prescription();
                    $diagnosis = $prescriptionModel->first(['prescription_id' => $prevAppointment[0]['prescription_id']])['diagnosis'] ?? 'No diagnosis available';

                    $medicationModel = new Prescribed_Medications();
                    $medications = $medicationModel->findWhere(['prescription_id' => $prevAppointment[0]['prescription_id']]) ?? [];

                    $prevAppointmentData = [
                        'appointment_date' => $prevAppointment[0]['appointment_date'],
                        'diagnosis' => $diagnosis,
                        'medications' => $medications
                    ];
            }
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $updatedHistory = [];
        
            // Build arrays from keys and values
            foreach (['allergies', 'chronic_conditions', 'past_surgeries', 'immunizations', 'family_medical_history', 'others'] as $section) {
                $keys = $_POST["{$section}_keys"] ?? [];
                $values = $_POST["{$section}_values"] ?? [];
                $updatedHistory[$section] = array_combine($keys, $values);
            }
                    
            $encodedUpdatedHistory = json_encode($updatedHistory);
            if($patientModel->update($patientId, ['medical_history' => $encodedUpdatedHistory], 'patient_id')){
                $_SESSION['success_message'] = 'Medical history updated successfully!';
            }
            $formattedHistory = $updatedHistory; // Update the history in view after saving

            // Redirect to the same page to avoid form resubmission
            redirect('drMedicalHistory/?appointment_id='. $appointmentId);
        }
        

        // Pass data to the view
        $this->view('drMedicalHistory', [
            'history' => $formattedHistory,
            'prevAppointmentData' => $prevAppointmentData,
            'appointmentId' => $appointmentId,
        ]);
    }
}
