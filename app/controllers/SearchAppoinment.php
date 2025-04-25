<?php

class SearchAppoinment
{
    use Controller;

    public function index()
    {
        $v1 = $_GET['v1'] ?? '';
        $doctor = new Doctor;
        $data = $doctor->findAlldata();

        foreach ($data as &$key) {
            $user = new User;
            $arr['user_id'] = $key['doctor_id'];
            $data1 = $user->first($arr);
            if ($data1) {
                $key = array_merge($key, $data1);
            }
        }
        unset($key);

        $data2 = [];
        $message = ''; // Message to display for errors or no results

        if (isset($_POST['search'])) {
            $doctor1 = new Doctor;

            $data3 = [
                'doctor' => $_POST['doctor'] ?? '',
                'specialization' => $_POST['specialization'] ?? '',
                'appointment_date' => $_POST['appointment_date'] ?? '',
            ];

            // Check if no search criteria are entered
            if (empty($data3['doctor']) && empty($data3['specialization']) && empty($data3['appointment_date'])) {
                $message = 'Please enter at least one search criteria.';
            } else {
                $_SESSION['appointment_date'] = $data3['appointment_date'];

                // Handle doctor name parts
                $nameparts = explode(" ", $data3['doctor']);
                $arr['firstName'] = $nameparts[0] ?? ''; // Use the first part if available
                $arr['lastName'] = $nameparts[1] ?? '';  // Use the second part if available
                $arr['specialization'] = $data3['specialization'] ?? '';

                // Function to get the day of the week
                function getDayOfWeek($dateString)
                {
                    $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    list($year, $month, $day) = explode('-', $dateString);
                    $timestamp = mktime(0, 0, 0, $month, $day, $year);
                    $dayIndex = date('w', $timestamp);
                    return $daysOfWeek[$dayIndex];
                }

                // Search logic
                if ($data3['appointment_date'] == '') {
                    $data2 = $doctor1->findDoctors($arr);
                }
                if ($data3['appointment_date'] != '' && $data3['specialization'] == '' && $data3['doctor'] == '') {
                    $weekday = getDayOfWeek($data3['appointment_date']);
                    $data2 = $doctor1->findDoctorsByDay($weekday);
                }
                if ($data3['appointment_date'] != '' && $data3['specialization'] != '' && $data3['doctor'] == '') {
                    $weekday = getDayOfWeek($data3['appointment_date']);
                    $data2 = $doctor1->findDoctorsBySpecializationAndDay($data3['specialization'], $weekday);
                }
                if ($data3['appointment_date'] != '' && $data3['specialization'] == '' && $data3['doctor'] != '') {
                    $weekday = getDayOfWeek($data3['appointment_date']);
                    $data2 = $doctor1->findDoctorsByNameAndDay($arr, $weekday);
                }

                // Check if no results are found
                if (empty($data2)) {
                    $message = 'No results found for the given criteria.';
                }
            }
        }

        // Pass the message to the view
        $this->view('searchappoinment', ['data' => $data, 'data2' => $data2, 'message' => $message]);
    }
}
