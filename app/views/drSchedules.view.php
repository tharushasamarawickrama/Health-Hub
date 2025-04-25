<?php

require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';
require APPROOT . '/views/Components/drCalendarComponent.php';
?>
<div class="dr-schedule-container">
<a href="<?php echo URLROOT; ?>drDashboard" class="profile-back-arrow"><img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back"></a>
    <div class="dr-schedule-content">
        <div class="schedule-left">
            <?php foreach ($schedules as $schedule) : ?>
                <div class="schedule-component"><?php echo
                                                $schedule['date']  . "<br>" .
                                                    date("gA", strtotime($schedule["start_time"])) . " - " .
                                                    date("gA", strtotime($schedule["end_time"])) .
                                                    "\t=>    " . $schedule["filled_slots"] . " appointments"; ?></div>
            <?php endforeach; ?>
        </div>
        <div class="schedule-right"><?php generateCalendar($schedules, $month, $year); ?></div>
    </div>
    <a href="<?php echo URLROOT; ?>drAvailability"><button class="schedule-update-btn">Update Availability</button></a>
</div>


<?php require APPROOT . '/views/Components/footer.php' ?>