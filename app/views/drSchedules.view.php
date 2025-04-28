<?php

require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';
require APPROOT . '/views/Components/drCalendarComponent.php';
?>
<div class="dr-schedule-container">
<a href="<?php echo URLROOT; ?>drDashboard" class="profile-back-arrow"><img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back"></a>
    <div class="dr-schedule-content">
        <div class="schedule-left">
            <?php if(!empty($allSchedules)): ?>
            <?php foreach ($allSchedules as $schedule) : 
                $displayDate = $schedule['date'];

                if($schedule['is_cancelled'] === 'optional') $displayDate .= " (optional slot)";

                //make the cancelled slots owned by the doctor to appear shaded
                $scheduleClass = 'schedule-component';
                if($schedule['is_cancelled'] == 'true'){
                    $scheduleClass .='-cancelled';
                    $displayDate .= " (cancelled slot)";
                }
            ?>
                <div class="<?php echo $scheduleClass?>"><?php echo
                                                $displayDate  . "<br>" .
                                                    date("gA", strtotime($schedule["start_time"])) . " - " .
                                                    date("gA", strtotime($schedule["end_time"])) .
                                                    "\t=>    " . $schedule["filled_slots"] . " appointments"; ?></div>
            <?php endforeach; ?>
            <?php else: ?>
                <div>No schedules available.</div>
            <?php endif; ?>
        </div>
        <div class="schedule-right"><?php generateCalendar($validSchedules, $month, $year); ?></div>
    </div>
    <a href="<?php echo URLROOT; ?>drAvailability"><button class="schedule-update-btn">Update Availability</button></a>
</div>


<?php require APPROOT . '/views/Components/footer.php' ?>