<?php

class DrPrescription {
    use Controller;

    public function index(){
        //$prescriptionId = 3;

        if (isset($_SESSION['success_message'])) {
            echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
            unset($_SESSION['success_message']);
        }

        if (!isset($_GET['appointment_id'])) {
            redirect('drViewAppointments');
        }
        
        $appointmentId = $_GET['appointment_id'];

        $appointmentModel = new Appointment();
        $appointment = $appointmentModel->getAppointmentById($appointmentId);

        $appointmentDate = $appointment['appointment_date'];

        $prescriptionId = $appointment['prescription_id'];

        $prescriptionModel = new Prescription();
        $prescription = $prescriptionModel->first(['prescription_id' => $prescriptionId]);

        $medicationModel = new Prescribed_Medications();
        $medications = $medicationModel->findWhere(['prescription_id' => $prescriptionId]);

        $this->view('drPrescription', [
            'prescription' => $prescription,
            'medications' => $medications,
            'appointment_id' => $appointmentId,
            'appointment_date' => $appointmentDate,
            'appointment_status' => $appointment['status'],
            ] );
    }
}