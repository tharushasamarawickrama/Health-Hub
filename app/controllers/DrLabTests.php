<?php

class DrLabTests {
    use Controller;
    public function index(){
        if (isset($_SESSION['success_message'])) {
            echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
            unset($_SESSION['success_message']);
        }

        if (!isset($_GET['appointment_id'])) {
            redirect('drViewAppointments');
        }

        if(isset($_GET['last_appointment'])) {
            $lastAppointmentId = $_GET['last_appointment'];
        } else {
            $lastAppointmentId = null;
        }

        $appointmentId = $_GET['appointment_id'];

        $labtestModel = new Labtest();
        $appointmentLabtestModel = new Appointment_Labtest();
        $appointmentModel = new Appointment();

        //fetch appointment date
        $appointmentDetails = $appointmentModel->getAppointmentById($appointmentId);
        $appointmentDate = $appointmentDetails['appointment_date'];
        $appointmentStatus = $appointmentDetails['status'];
        // var_dump($appointmentDate);
        // exit;

        // Fetch lab test names by appointment ID
        $fetchedLabTests = $appointmentLabtestModel->getLabTestNamesByAppointmentId($appointmentId);

        $labTests = $labtestModel->getLabTestsByCategory();
        $uncategorizedTests = $labtestModel->getUncategorizedLabTests();

        //fetch lab report details for viewing
        $labReports = $appointmentLabtestModel->getLabReportDetailsByAppointmentId($appointmentId);
        $mappedLabReports = array_combine(
            array_column($labReports, 'labtest_name'), 
            array_column($labReports, 'labtest_report')
        );

        // Handle POST request for saving selected tests
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['tests']) && !empty($_POST['tests'])) {
                $selectedTestNames = $_POST['tests']; // Array of selected test names
                $labTestNamesString = implode(',', $selectedTestNames);

                // Get lab test IDs for the selected test names
                $newLabTestIds = array_column($labtestModel->getLabTestIdsByNames($labTestNamesString), 'labtest_id');

                // Update the appointment_labtest table
                if($appointmentLabtestModel->updateLabTestsForAppointment($appointmentId, $newLabTestIds)){
                    $_SESSION['success_message'] = "Lab tests updated successfully.";
                }
                else{
                    $_SESSION['success_message'] = "Failed to update lab tests.";
                }

                redirect('drLabTests/?appointment_id=' . $appointmentId);
            } else {
                if($appointmentLabtestModel->delete($appointmentId, 'appointment_id'))
                    $_SESSION['success_message'] = "Tests removed.";
                else
                    $_SESSION['success_message'] = "Failed to remove tests.";
                redirect('drLabTests/?appointment_id=' . $appointmentId);
            }
        }

        // Pass data to the view
        $data = [
            'labTests' => $labTests,
            'uncategorizedTests' => $uncategorizedTests,
            'fetchedLabTests' => $fetchedLabTests,
            'labReports' => $mappedLabReports,
            'appointment_id' => $appointmentId,
            'appointment_date' => $appointmentDate,
            'appointment_status' => $appointmentStatus,
            'last_appointment_id' => $lastAppointmentId,
        ];

        $this->view('drLabTests', $data);
    }
}