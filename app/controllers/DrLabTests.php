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

        $appointmentId = $_GET['appointment_id'];

        $labtestModel = new Labtest();
        $appointmentModel = new Appointment();

        // Fetch lab test IDs as a string from the appointment table
        $labTestIdsString = $appointmentModel->getLabTestIdsByAppointmentId($appointmentId)[0]['labtest_id'];

        $fetchedLabTests = [];
        // Fetch lab tests by IDs
        if($labTestIdsString) $fetchedLabTests = $labtestModel->getLabTestsByIds($labTestIdsString);

        // Fetch all categorized and uncategorized lab tests
        $labTests = $labtestModel->getLabTestsByCategory();
        $uncategorizedTests = $labtestModel->getUncategorizedLabTests();

        // Handle POST request for saving selected tests
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['tests']) && !empty($_POST['tests'])) {
                $selectedTestIds = $_POST['tests']; // Array of selected test IDs
                $labTestNamesString = implode(',', $selectedTestIds);

                $newLabTestIds = $labtestModel->getLabTestIdsAsCommaString($labTestNamesString);

        //         echo "<pre>";
        // echo "Categorized Lab Tests:\n";
        // print_r($newLabTestIds);
        // echo "</pre>";
        // exit;

                // Update lab test IDs in the appointment table
                if($appointmentModel->update($appointmentId, ['labtest_id' => $newLabTestIds], 'appointment_id')){
                    $_SESSION['success_message'] = "Lab tests updated successfully.";
                }
                else{
                    $_SESSION['success_message'] = "Failed to update lab tests.";
                }

                redirect('drLabTests/index?appointment_id=' . $appointmentId);
            } else {
                $appointmentModel->update($appointmentId, ['labtest_id' => ''], 'appointment_id');
                $_SESSION['success_message'] = "Tests removed.";
                redirect('drLabTests/index?appointment_id=' . $appointmentId);
            }
        }

        // Pass data to the view
        $data = [
            'labTests' => $labTests,
            'uncategorizedTests' => $uncategorizedTests,
            'fetchedLabTests' => $fetchedLabTests,
        ];

        $this->view('drLabTests', $data);
    }
}