<?php

class PatientHistory
{
    use Controller;
    public function index()
    {
        $id = $_SESSION['user']['user_id'];
        $appointment = new Appointment;
        $appointments = $appointment->getAppointmentsByUserId($id);
        if ($appointments) {

            foreach ($appointments as $appointment) { // Use reference to modify the original array
                $prescription = new Prescription;
                $labtest = new LabTest;
                $prescriptionMed = new Prescribed_Medications;
                $appointmentlabtest = new Appointment_LabTest;
                $arr['prescription_id'] = $appointment['prescription_id'];
                $arr1['labtest_id'] = $appointment['labtest_id'];
                $prescriptiondata1 = $prescription->first($arr);
                $labtestdata = $labtest->first($arr1);
                $appointmentlabtestdata = $appointmentlabtest->getLabTestByAppointmentId($appointment['appointment_id']);
                $prescriptiondata2 = $prescriptionMed->getmedicatesInprescription($appointment['prescription_id']);
                $combinedData = [
                    'appointment' => $appointment,
                    'prescription' => $prescriptiondata1,
                    'prescriptionMed' => $prescriptiondata2,
                    'labtest' => $labtestdata,
                    'appointmentlabtest' => $appointmentlabtestdata,
                ];
                $data[] = $combinedData;
                // show($data);  

                // Debugging output


                // $labtestdata = $labtest->first(['labtest_id' => $appointment['labtest_id']]);
                // $appointment['prescription'] = $prescriptiondata1;
                // $appointment['labtest'] = $labtestdata;
            }
        }



        $this->view('patienthistory', ['data' => $data]);
    }
}
