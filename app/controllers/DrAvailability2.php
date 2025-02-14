<?php

class DrAvailability2 {
    use Controller;
    
    public function index(){
        $doctorId = $_SESSION['user']['user_id'];
        $ScheduleTimeModel = new ScheduleTime();

        // Get today's date
        $currentDate = new DateTime();

        // Define a fixed reference Monday (first Monday of 2025: 06/01/2025)
        $referenceMonday = new DateTime("2025-01-06");

        // Calculate the difference in weeks between today and the reference Monday
        $weekDifference = floor($referenceMonday->diff($currentDate)->days / 7);

        // Find the Monday that aligns with the 2-week cycle
        $startDate = clone $referenceMonday;
        $startDate->modify("+" . (floor($weekDifference / 2) * 2) . " weeks");
        $endDate = (clone $startDate)->modify('+13 days');

        // Format as YYYY-MM-DD for SQL queries
        $start_date_str = $startDate->format("Y-m-d");
        $end_date_str = $endDate->format("Y-m-d");
        // var_dump($start_date_str);
        // exit();

        // Handle POST request to save updated timeslots
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updatedTimeslots = isset($_POST['selectedTimeslots']) ? $_POST['selectedTimeslots'] : '';
            
            $updatedTimeslots = json_decode($_POST['selectedTimeslots']);
            // var_dump($updatedTimeslots);
            // exit();

            $ScheduleTimeModel->deleteBeforeUpdate($doctorId, $start_date_str, $end_date_str);

            if (!empty($updatedTimeslots)) {
                $formattedSlots = [];

                foreach($updatedTimeslots as $slot){
                    $date = DateTime::createFromFormat('d/m/Y', $slot[0]);
                    $formattedDate = $date ? $date->format("Y-m-d") : null;
                    
                    $timeParts = explode(' - ', $slot[1]);

                    $updatedStartTime = DateTime::createFromFormat('gA', trim($timeParts[0]))->format('H:i:s');
                    $updatedEndTime = DateTime::createFromFormat('gA', trim($timeParts[1]))->format('H:i:s');

                    $formattedSlots[] = [
                        'doctor_id' => $doctorId,
                        'date' => $formattedDate,
                        'start_time' => $updatedStartTime,
                        'end_time' => $updatedEndTime,
                        'filled_slots' => 0, // Set filled slots to 0 initially
                        'total_slots' => 0
                    ];
                    
                }

                foreach($formattedSlots as $slot){
                    $ScheduleTimeModel->insert($slot);
                }
                
                // var_dump($formattedSlots);
                // exit();
            }
            $_SESSION['success_message'] = 'Availability updated successfully!';
            redirect('drAvailability2');
        }

        $schedules = $ScheduleTimeModel->getScheduleByDoctor($doctorId, $start_date_str, $end_date_str);

        $fetchedTimeslots = [];

        if (empty($schedules)) {
            $fetchedTimeslots = [];
        }
        else{
            foreach ($schedules as $schedule) {
                $date = date("d/m/Y", strtotime($schedule["date"]));
                $startTime = date("gA", strtotime($schedule["start_time"]));
                $endTime = date("gA", strtotime($schedule["end_time"]));
                $timeslot = [$date, "$startTime - $endTime"];
                $fetchedTimeslots[] = $timeslot;
            }
        }
        
        //$occupiedTimeslots = [];
        // Fetch all occupied slots within this 2-week range
        //$occupiedTimeslots = $ScheduleTimeModel->getOccupiedTimeslots($start_date_str, $end_date_str);

        $occupiedTimeslots = [];

        // Fetch disabled slots within this 2-week range
        $occupiedTimeslots = $ScheduleTimeModel->getOccupiedSlots($doctorId, $start_date_str, $end_date_str);
        if (!empty($occupiedTimeslots)) {
            foreach ($occupiedTimeslots as &$slot) {
                $slot['date'] = date("d/m/Y", strtotime($slot["date"]));
                $slot['time'] = date("gA", strtotime($slot["start_time"])) . " - " . date("gA", strtotime($slot["end_time"]));
                unset($slot["start_time"], $slot["end_time"]); // Remove original keys
            }            
        }

        // var_dump($occupiedTimeslots);
        // exit();

        // Pass start and end dates to the view if needed
        $this->view('drAvailability2', [
            'fetchedTimeslots' => $fetchedTimeslots,
            'startDate' => $startDate,
            'endDate' => $end_date_str,
            'occupiedTimeslots' => $occupiedTimeslots
        ]);
    }    
}
