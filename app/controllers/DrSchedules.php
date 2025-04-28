<?php

class DrSchedules {
    use Controller;
    public function index(){
        $doctorId = $_SESSION['user']['user_id'];
        $ScheduleTimeModel = new ScheduleTime();

        $validSchedules = $ScheduleTimeModel->getValidSlotsByDoctor($doctorId);
        $allSchedules = $ScheduleTimeModel->getScheduleByDoctor($doctorId);
        // var_dump($schedules);
        // exit;
        function getDateOfWeekday(string $weekday): string {
            $date = new DateTime();
            $date->modify("this week $weekday");
            return $date->format('Y-m-d');
        }

        if($validSchedules){
            foreach ($validSchedules as &$schedule) {
                $schedule['date'] = getDateOfWeekday($schedule["weekday"]);
            }
        }
        if($allSchedules){
            foreach ($allSchedules as &$schedule) {
                $schedule['date'] = getDateOfWeekday($schedule["weekday"]);
            }
        }
        $this->view('drSchedules', ['validSchedules' => $validSchedules, 'allSchedules' => $allSchedules]);
    }
}