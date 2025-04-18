<?php

class DrCalendar {
    use Controller;
    public function index(){
        $doctorId = $_SESSION['user']['user_id'];
        $ScheduleTimeModel = new ScheduleTime();

        $schedules = $ScheduleTimeModel->getScheduleByDoctor($doctorId);
        // var_dump($schedules);
        // exit;
        $this->view('drCalendar', ['schedules' => $schedules]);
    }
}