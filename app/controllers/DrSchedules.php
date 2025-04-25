<?php

class DrSchedules {
    use Controller;
    public function index(){
        $doctorId = $_SESSION['user']['user_id'];
        $ScheduleTimeModel = new ScheduleTime();

        $schedules = $ScheduleTimeModel->getScheduleByDoctor($doctorId);
        // var_dump($schedules);
        // exit;
        function getDateOfWeekday(string $weekday): string {
            $date = new DateTime();
            $date->modify("this week $weekday");
            return $date->format('Y-m-d');
        }

        if($schedules){
            foreach ($schedules as &$schedule) {
                $schedule['date'] = getDateOfWeekday($schedule["weekday"]);
            }
        }
        $this->view('drSchedules', ['schedules' => $schedules]);
    }
}