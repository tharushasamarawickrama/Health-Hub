<?php

class DrDashboard
{
    use Controller;

    public function index()
    {
        $doctorId = $_SESSION['user']['user_id'];

        // Initialize models
        $appointmentModel = new Appointment();
        $doctorModel = new Doctor();

        // Fetch the doctor type
        $doctorType = $doctorModel->getDoctorTypeById($doctorId)[0]['type'];
        $_SESSION['doctor_type'] = $doctorType; // Store doctor type in session
        
        // Fetch appointments for the doctor
        $appointments = $appointmentModel->getTodaysAppointments($doctorId);
        
        // Check if $appointments is valid
        $appointmentsToday = [];
        if (is_array($appointments) && !empty($appointments)) {
            // Fetch patient details for the appointments
            foreach ($appointments as $appointment) {
                if ($appointment) {
                    $appointmentsToday[] = [
                        'id' => '#' . str_pad($appointment['appointment_id'], 4, '0', STR_PAD_LEFT),
                        'name' => $appointment['title'] . ' ' . $appointment['p_firstName'] . ' ' . $appointment['p_lastName']
                    ];
                }
            }
        }

        $todaysSlots = [];
        $calendarSchedules = [];
        // Fetch past appointments for the doctor
        $pastAppointments = [];
        if($doctorType == 'opd') {
            $pastAppointments = $appointmentModel->getLimitedPastAppointments($doctorId);
            if($pastAppointments){
                $pastAppointments = array_reverse(array_combine(
                    array_column($pastAppointments, 'appointment_date'),
                    array_column($pastAppointments, 'appointment_count')
                ));
            }
        }
        elseif($doctorType == 'specialist'){
            $ScheduleTimeModel = new ScheduleTime();
            $schedules = $ScheduleTimeModel->getPastSchedulesByDoctor($doctorId);
            $todaysSlots = $ScheduleTimeModel->getTodaysSlotsByDoctor($doctorId);
            $calendarSchedules = $ScheduleTimeModel->getScheduleByDoctor($doctorId);
            
            // var_dump($calendarSchedules);
            // exit();

            function getDateOfWeekday(string $weekday): string {
                $date = new DateTime();
                $date->modify("this week $weekday");
                return $date->format('Y-m-d');
            }

            if($schedules){
                foreach ($schedules as $schedule) {
                    $date = getDateOfWeekday($schedule["weekday"]);
                    // Format date (remove leading zeros in day/month)
                    $formattedDate = date("j/n/y", strtotime($date));
                    // Format start and end times
                    $startTime = date("gA", strtotime($schedule["start_time"]));
                    $endTime = date("gA", strtotime($schedule["end_time"]));
                    // Combine into key and assign filled slots as value
                    $key = "$formattedDate | $startTime-$endTime";
                    $pastAppointments[$key] = $schedule["filled_slots"];
                }
            }

            if($calendarSchedules){
                foreach($calendarSchedules as &$schedule){ $schedule["date"] = getDateOfWeekday($schedule["weekday"]); }
            }
        }
        


        // Load the view and pass the data
        $this->view('drDashboard',[
            'appointmentsToday' => $appointmentsToday,
            'pastAppointments' => $pastAppointments,
            'todaysSlots' => $todaysSlots,
            'schedules' => $calendarSchedules,
            'doctorType' => $doctorType,
        ]);
    }
}
