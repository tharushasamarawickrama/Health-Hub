<?php

class DrPrescription {
    use Controller;

    public function index(){
        $prescriptionId = 3;
        if (isset($_SESSION['success_message'])) {
            echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
            unset($_SESSION['success_message']);
        }

        $prescriptionModel = new Prescription();
        $prescription = $prescriptionModel->first(['prescription_id' => $prescriptionId]);

        $medicationModel = new Prescribed_Medications();
        $medications = $medicationModel->findWhere(['prescription_id' => $prescriptionId]);

        $this->view('drPrescription', ['prescription' => $prescription, 'medications' => $medications]);
    }
}