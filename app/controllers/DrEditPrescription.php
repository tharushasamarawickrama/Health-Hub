<?php

class DrEditPrescription {
    use Controller;

    public function index() {
        $prescriptionId = 3; // Example
        $prescriptionModel = new Prescription();
        $medicationModel = new Prescribed_Medications();
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $formattedData = json_decode($_POST['formatted_prescription_data'], true);
        
            $diagnosis = $formattedData['diagnosis'];
            $medications = $formattedData['medications'];
        
            // Save diagnosis and medications to the database
            $prescriptionModel->update($prescriptionId, ['diagnosis' => $diagnosis], 'prescription_id');
        
            $medicationModel->deleteWhere(['prescription_id' => $prescriptionId]); // Clear existing medications
        
            foreach ($medications as $medication) {
                $medication['prescription_id'] = $prescriptionId; // Add prescription ID
                $medicationModel->insert($medication);
            }
        
            $_SESSION['success_message'] = 'Prescription updated successfully!';
            redirect('drPrescription');
        } else {
            $prescription = $prescriptionModel->first(['prescription_id' => $prescriptionId]);
            $medications = $medicationModel->findWhere(['prescription_id' => $prescriptionId]);
    
            $this->view('drEditPrescription', [
                'prescription' => $prescription,
                'medications' => $medications,
            ]);
        }
    }
    

    // public function index(){
    //     $prescriptionId = 1;
    //     $prescriptionModel = new Prescription();
    //     $prescription = $prescriptionModel->first(['prescription_id' => $prescriptionId]);

    //     $medicationModel = new Prescribed_Medications();
    //     $medications = $medicationModel->findWhere(['prescription_id' => $prescriptionId]);

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {}

    //     else{
    //         $this->view('drEditPrescription', ['prescription' => $prescription, 'medications' => $medications]);
    //     }

    // }

    // public function index() {
    //     $doctorId = 5; // Hardcoded doctor ID (can be dynamic based on session/login)
    //         require_once "../app/models/Doctor.php";
    //         $doctorModel = new Doctor();
    //         $doctorData = $doctorModel->first(['doctor_id' => $doctorId]);
        
    //         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //             $data = [
    //                 'firstName'    => htmlspecialchars(trim($_POST['firstName']), ENT_QUOTES, 'UTF-8'),
    //                 'lastName'     => htmlspecialchars(trim($_POST['lastName']), ENT_QUOTES, 'UTF-8'),
    //                 'description'    => htmlspecialchars(trim($_POST['description']), ENT_QUOTES, 'UTF-8'),
    //                 'experience'     => htmlspecialchars(trim($_POST['experience']), ENT_QUOTES, 'UTF-8'),
    //                 'specialties'    => htmlspecialchars(trim($_POST['specialties']), ENT_QUOTES, 'UTF-8'),
    //                 'certifications' => htmlspecialchars(trim($_POST['certifications']), ENT_QUOTES, 'UTF-8'),
    //                 'phoneNumber'    => trim($_POST['phoneNumber']),
    //                 'email'          => trim($_POST['email']),
    //             ];
        
    //             $errors = [];
    //             if (empty($data['description'])) {
    //                 $errors[] = 'Description is required.';
    //             }
        
    //             if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    //                 $errors[] = 'Invalid email address.';
    //             }
        
    //             if (!preg_match('/^[0-9]{10,15}$/', $data['phoneNumber'])) {
    //                 $errors[] = 'Phone number must be between 10 to 15 digits.';
    //             }
        
    //             if (empty($errors)) {
    //                 if ($doctorModel->update($doctorId, $data, 'doctor_id')) {
    //                     $_SESSION['success_message'] = 'Profile updated successfully!';
    //                     redirect('drProfile');
    //                     exit;
    //                 } else {
    //                     $this->view('drProfile', [
    //                         'doctorData' => $data,
    //                         'error'      => 'Failed to update profile. Please try again.',
    //                     ]);
    //                 }
    //             } else {
    //                 $this->view('drEditProfile', [
    //                     'doctorData' => $data,
    //                     'error'      => implode('<br>', $errors),
    //                 ]);
    //             }
    //         } else {
    //             $doctorData = $doctorModel->first(['doctor_id' => $doctorId]);
    //             $this->view('drEditProfile', ['doctorData' => $doctorData]);
    //         }
    //     }
}