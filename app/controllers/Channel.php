<?php

class Channel
{
    use Controller;
    public function index()
    {
        // echo "This is Home Controller";
        $id = $_GET['id'];
        $doctor = new Doctor;
        $arr['doctor_id'] = $id;
        $data = $doctor->first($arr);
        if ($data) {
            $user = new User;
            $arr1['user_id'] = $data['doctor_id'];
            $data1 = $user->first($arr1);
            if ($data1) {
                $data = array_merge($data, $data1);
                // print_r($data);
            }
        }

        function getDayOfWeek($dateString)
        {
            // Define an array of day names
            $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            // Parse the input date string into an array
            list($year, $month, $day) = explode('-', $dateString);

            // Get the timestamp for the given date
            $timestamp = mktime(0, 0, 0, $month, $day, $year);

            // Get the day of the week as a number (0-6)
            $dayIndex = date('w', $timestamp);

            // Return the corresponding day name
            return $daysOfWeek[$dayIndex];
        }

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

        $scedule = new ScheduleTime;
        if ($_SESSION['appointment_date'] == '') {
            $data2 = $scedule->getScheduleByDoctor($id);
        } else {
            $data2 = $scedule->getSchedule($id, getDayOfWeek($_SESSION['appointment_date']));
        }

        foreach ($data2 as &$key) {
            $dayName = $key['weekday'];
            $date['appo_data'] = getDateForDay($dayName);
            if ($date) {
                $key = array_merge($key, $date);
            }
        }
        //print_r($_SESSION['appointment_date']);
        // show($data2);
        $this->view('channel', $data, $data2);
    }

}
