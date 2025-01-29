<?php

class DrAvailability2 {
    use Controller;
    public function index(){
        $doctorId = $_SESSION['user']['user_id'];
        $ScheduleTimeModel = new ScheduleTime();

        $schedules = $ScheduleTimeModel->getScheduleByDoctor($doctorId);

        $fetchedTimeslots = [];

        if (empty($schedules)) {
            $fetchedTimeslots = [];
        }
        
        foreach ($schedules as $schedule) {
            $date = date("d/m/Y", strtotime($schedule["date"]));
            $startTime = date("gA", strtotime($schedule["start_time"]));
            $endTime = date("gA", strtotime($schedule["end_time"]));
            $timeslot = [$date, "$startTime - $endTime"];
            $fetchedTimeslots[] = $timeslot;
        }

        // var_dump($fetchedTimeslots);
        // exit();

        $this->view('drAvailability2', ['fetchedTimeslots' => $fetchedTimeslots]);
    }    
}