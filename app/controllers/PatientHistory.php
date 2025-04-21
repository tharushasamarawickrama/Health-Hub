<?php

class PatientHistory
{
    use Controller;
    public function index()
    {
        $labtest =[];
        $id = $_SESSION['user']['user_id'];
        $appointment = new Appointment;
        $referaluser = $appointment->getDistinctReferalAndUserDetails($id);
        $appointments = $appointment->getAppointmentsByUserId($id);
        if ($appointments) {

            foreach ($appointments as $appointment) { // Use reference to modify the original array
                $prescription = new Prescription;
                $labtest = new LabTest;
                $prescriptionMed = new Prescribed_Medications;
                $appointmentlabtest = new Appointment_LabTest;
                $arr['prescription_id'] = $appointment['prescription_id'];
                // $arr1['appointment_id'] = $appointment['appointment_id'];
                $prescriptiondata1 = $prescription->first($arr);
                // $labtestdata = $labtest->first($arr1);
                $appointmentlabtestdata = $appointmentlabtest->getLabTestByAppointmentId($appointment['appointment_id']);
                foreach($appointmentlabtestdata as $appolab){
                    $arr1['labtest_id'] = $appolab['labtest_id'];
                    $labtestdata[] = $labtest->first($arr1);
                
                }
                // show($labtestdata);
                $prescriptiondata2 = $prescriptionMed->getmedicatesInprescription($appointment['prescription_id']);
                if($appointment['referal_id']== 0){
                    $patient = new Patient;
                    $arr2['patient_id'] = $appointment['patient_id'];
                    $patientdata = $patient->getMedicalHistoryByPatientId($appointment['patient_id']);
       
                }else{
                    $patient = new Patient_Referal;
                    // $arr2['patient_id'] = $appointment['patient_id'];
                    $arr2['referal_id'] = $appointment['referal_id'];
                    $patientdata = $patient->getMedicalHistory($appointment['patient_id'], $appointment['referal_id']);
                }
                $combinedData = [
                    'appointment' => $appointment,
                    'prescription' => $prescriptiondata1,
                    'prescriptionMed' => $prescriptiondata2,
                    'labtest' => $labtestdata,
                    'appointmentlabtest' => $appointmentlabtestdata,
                    'patient' => $patientdata,
                ];
                $data[] = $combinedData;
                // show($data);  

                // Debugging output


                // $labtestdata = $labtest->first(['labtest_id' => $appointment['labtest_id']]);
                // $appointment['prescription'] = $prescriptiondata1;
                // $appointment['labtest'] = $labtestdata;
            }
        }



        $this->view('patienthistory', ['data' => $data, 'referaluser' => $referaluser]);
    }
}
