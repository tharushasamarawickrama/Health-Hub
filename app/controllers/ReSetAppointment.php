<?php

class ReSetAppointment
{
    use Controller;

    public function index()
    {
        $id = $_GET['id'] ?? null;
        $sch_id = $_GET['sch_id'] ?? null;

        $appointment = new Appointment;
        if(isset($_SESSION['user'])){
            $referal = $appointment->getDistinctReferalAndUserDetails($_SESSION['user']['user_id']);
            $referal = array_filter($referal, function ($item) {
                return $item['referal_id'] != 0;
            });
    
            // Re-index the array to maintain sequential keys
            $referal = array_values($referal);
        }
        

        $errors = []; // Array to store validation errors
        
        // Handle form submission for appointment
        if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
            // Sanitize input data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'p_firstName' => trim($_POST['p_firstName']),
                'p_lastName' => trim($_POST['p_lastName']),
                'nic' => trim($_POST['nic']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'age' => trim($_POST['age']),
                'address' => trim($_POST['address']),
                'email' => trim($_POST['email']),
                'gender' => $_POST['gender'] ?? '',
                'title' => $_POST['Title'] ?? '',
                'add_service' => $_POST['addservice'] ?? '',
                'doctor_id' => $id,
                'patient_id' => isset($_SESSION['user']) ? $_SESSION['user']['user_id'] : 0,
                'payment_status' => 'pending',
                'referal_id' => isset($_SESSION['user']) ? ($_POST['patientType'] ?? '') : 0,
                'isdeleted' => 0,
                'status' => 'new',
                'schedule_id' => $sch_id,
            ];

            

            // Backend validation
            if (empty($data['p_firstName'])) {
                $errors['p_firstName'] = 'First name is required.';
            }
            if (empty($data['p_lastName'])) {
                $errors['p_lastName'] = 'Last name is required.';
            }
            if (
                empty($data['nic']) ||
                !preg_match('/^[0-9]{9}[vVxX]$/', $data['nic']) &&
                !preg_match('/^[0-9]{12}$/', $data['nic'])
            ) {
                $errors['nic'] = 'Valid NIC is required.';
            }
            if (empty($data['phoneNumber']) || !preg_match('/^0[0-9]{9}$/', $data['phoneNumber'])) {
                $errors['phoneNumber'] = 'Valid phone number is required.';
            }
            if (empty($data['age']) || !is_numeric($data['age']) || $data['age'] <= 0) {
                $errors['age'] = 'Valid age is required.';
            }
            if (empty($data['address'])) {
                $errors['address'] = 'Address is required.';
            }
            if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Valid email is required.';
            }
            if (empty($data['gender'])) {
                $errors['gender'] = 'Gender is required.';
            }
            if (empty($data['title'])) {
                $errors['title'] = 'Title is required.';
            }
            if (empty($data['add_service'])) {
                $errors['add_service'] = 'You must agree to add the service charge.';
            }
            // If there are no errors, proceed with appointment creation
            if (empty($errors)) {
                
                $schedule = new ScheduleTime;
                $scheduleData = $schedule->first(['schedule_id' => $sch_id]);
                $data['appointment_No'] = $scheduleData['filled_slots'] + 1;

                function getDateForDay($dayName)
                {
                    $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    $currentDate = new DateTime();
                    $targetDayNumber = array_search(ucfirst(strtolower($dayName)), $daysOfWeek);

                    if ($targetDayNumber === false) {
                        return "Invalid day name";
                    }

                    $currentDayNumber = (int)$currentDate->format('w');
                    $daysDifference = $targetDayNumber - $currentDayNumber;

                    if ($daysDifference <= 0) {
                        $daysDifference += 7;
                    }

                    $currentDate->modify("+$daysDifference days");
                    return $currentDate->format('Y-m-d');
                }

                $date = getDateForDay($scheduleData['weekday']);
                $data['appointment_date'] = $date;

                $_SESSION['appointment'] = $data;

                // Redirect to the next page
                redirect('repatientchannel');
            }
        }

        // show($referal);
        // Load the view without any pre-filled data
        if (isset($_SESSION['user'])) {
            $this->view('resetappointment', ['referal' => $referal, 'errors' => $errors, 'id' => $id, 'sch_id' => $sch_id]);
        } else {
            $this->view('resetappointment', ['errors' => $errors, 'id' => $id, 'sch_id' => $sch_id]);
        }
    }
}