<?php

class DrEditPrescription {
    use Controller;

    public function index() {

        $appointmentId = $_GET['appointment_id'];

        $appointmentModel = new Appointment();
        $appointment = $appointmentModel->getAppointmentById($appointmentId);

        $prescriptionId = $appointment['prescription_id'] ?? null;

        $prescriptionModel = new Prescription();
        $medicationModel = new Prescribed_Medications();
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $formattedData = json_decode($_POST['formatted_prescription_data'], true);
        
            $diagnosis = $formattedData['diagnosis'];
            $medications = $formattedData['medications'];
        
            // Save diagnosis and medications to the database
            if($prescriptionId){
                $prescriptionModel->update($prescriptionId, ['diagnosis' => $diagnosis], 'prescription_id');
            }
            else{
                $prescriptionId = $prescriptionModel-> insertAndGetId(['diagnosis' => $diagnosis]);

                 // Update the appointment with the new prescription ID
                $appointmentModel->update($appointmentId, ['prescription_id' => $prescriptionId], 'appointment_id');
            }
        
            $medicationModel->deleteWhere(['prescription_id' => $prescriptionId]); // Clear existing medications
        
            foreach ($medications as $medication) {
                if(!empty($medication['name'])){
                    $medication['prescription_id'] = $prescriptionId; // Add prescription ID
                    $medicationModel->insert($medication);
                }
                
            }
        
            $_SESSION['success_message'] = 'Prescription updated successfully!';
            redirect('drPrescription?appointment_id='.$appointmentId);
        } else {
            $prescription = $prescriptionModel->first(['prescription_id' => $prescriptionId]);
            $medications = $medicationModel->findWhere(['prescription_id' => $prescriptionId]);
    
            $this->view('drEditPrescription', [
                'prescription' => $prescription,
                'medications' => $medications,
                'appointment_id' => $appointmentId
            ]);
        }
    }
}