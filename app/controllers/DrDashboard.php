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
        //var_dump($appointments);
        
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
            // var_dump($pastAppointments);
            // exit();
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

            if($schedules){
                foreach ($schedules as $schedule) {
                    // Format date (remove leading zeros in day/month)
                    $date = date("j/n/y", strtotime($schedule["date"]));
                    // Format start and end times
                    $startTime = date("gA", strtotime($schedule["start_time"]));
                    $endTime = date("gA", strtotime($schedule["end_time"]));
                    // Combine into key and assign filled slots as value
                    $key = "$date | $startTime-$endTime";
                    $pastAppointments[$key] = $schedule["filled_slots"];
                }
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
