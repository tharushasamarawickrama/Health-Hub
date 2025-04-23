<?php

class DrAvailability2
{
    use Controller;

    public function index()
    {
        $doctorId = $_SESSION['user']['user_id'];
        $isFirstLogin = ($_SESSION['user']['last_login'] == NULL) ? true : false;
        $ScheduleTimeModel = new ScheduleTime();

        function getDateOfWeekday(string $weekday): string
        {
            $date = new DateTime();
            $date->modify("this week $weekday");
            return $date->format('Y-m-d');
        }

        $today = date('l');

        // Handle POST request to save updated timeslots
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updatedTimeslots = isset($_POST['selectedTimeslots']) ? json_decode($_POST['selectedTimeslots'], true) : [];
            $originalSlots = isset($_POST['originalOccupiedSlots']) ? json_decode($_POST['originalOccupiedSlots'], true) : [];

            // Convert arrays to strings for easier comparison
            $updatedJson = array_map('json_encode', $updatedTimeslots);
            $originalJson = array_map('json_encode', $originalSlots);

            // Find added and removed by comparing encoded versions
            $addedJson = array_diff($updatedJson, $originalJson);
            $removedJson = array_diff($originalJson, $updatedJson);

            // Decode back to original arrays
            $addedSlots = array_map('json_decode', $addedJson);
            $removedSlots = array_map('json_decode', $removedJson);

            //send deleted slots to admin and handle deleted slots
            if(!empty($removedSlots)){
                foreach ($removedSlots as $slot) {
                    $date = DateTime::createFromFormat('d/m/Y', $slot[0]);
                    $dayName = $date->format('l');
    
                    $startTime = DateTime::createFromFormat('gA', trim(explode(' - ', $slot[1])[0]))->format('H:i:s');
                    $endTime = DateTime::createFromFormat('gA', trim(explode(' - ', $slot[1])[1]))->format('H:i:s');
    
                    // Assuming you have a method to handle the cancellation
                    $scheduleDetails = $ScheduleTimeModel->getScheduleBySlot($doctorId, $dayName, $startTime, $endTime)[0];
                    $scheduleId = $scheduleDetails['schedule_id'];
                    $SpecialistNotifModel = new Specialist_Notifications();
                    $SpecialistNotifModel->insert(['schedule_id' => $scheduleId, 'doctor_id' => $doctorId]);

                    if($scheduleDetails['is_cancelled'] === 'optional')
                        $ScheduleTimeModel->deleteOptionalSlot($doctorId, $scheduleId);
                    else
                        $ScheduleTimeModel->updateSomeField($scheduleId, $doctorId, 'is_cancelled' , 'true');

                }
            }
            
            //handle added slots
            if(!empty($addedSlots)){
                foreach ($addedSlots as $slot) {
                    $date = DateTime::createFromFormat('d/m/Y', $slot[0]);
                    $dayName = $date->format('l');

                    $startTime = DateTime::createFromFormat('gA', trim(explode(' - ', $slot[1])[0]))->format('H:i:s');
                    $endTime = DateTime::createFromFormat('gA', trim(explode(' - ', $slot[1])[1]))->format('H:i:s');

                    $ScheduleTimeModel->handleAddedSchedules($doctorId, $dayName, $startTime, $endTime);
                }
            }
            $_SESSION['success_message'] = 'Availability updated successfully!';
            redirect('drAvailability2');
            }

        $fetchedSlots = [];
        $availableSlots = [];
        $doctorSlots = [];
        $optionalSlots = [];
        $occupiedSlots = [];

        $fetchedSlots = $ScheduleTimeModel->getScheduleByDoctor($doctorId);
        $availableSlots = $ScheduleTimeModel->getAvailableSlots();

        if ($fetchedSlots) {
            foreach ($fetchedSlots as $slot) {
                $date = getDateOfWeekday($slot['weekday']);
                $formattedDate = date("d/m/Y", strtotime($date));
                $startTime = date("gA", strtotime($slot["start_time"]));
                $endTime = date("gA", strtotime($slot["end_time"]));
                $timeslot = [$formattedDate, "$startTime - $endTime"];

                if ($slot['is_cancelled'] != 'true') $occupiedSlots[] = $timeslot;
                if ($slot['is_cancelled'] != 'optional') $doctorSlots[] = $timeslot;
            }
        }

        if ($availableSlots) {
            foreach ($availableSlots as $slot) {
                $date = getDateOfWeekday($slot["weekday"]);
                $formattedDate = date("d/m/Y", strtotime($date));
                $startTime = date("gA", strtotime($slot["start_time"]));
                $endTime = date("gA", strtotime($slot["end_time"]));
                $timeslot = [$formattedDate, "$startTime - $endTime"];

                if ($slot['is_cancelled'] === 'optional') $optionalSlots[] = $timeslot;
                if ($isFirstLogin) {
                    if ($slot['is_cancelled'] != 'optional') $doctorSlots[] = $timeslot;
                }
            }
        }
        // var_dump($occupiedSlots);
        // exit();

        // Pass start and end dates to the view if needed
        $this->view('drAvailability2', [
            'doctorSlots' => $doctorSlots,
            'occupiedSlots' => $occupiedSlots,
            'optionalSlots' => $optionalSlots,
        ]);
    }
}
