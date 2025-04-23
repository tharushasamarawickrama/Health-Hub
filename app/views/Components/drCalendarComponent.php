<?php

$month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

$title = "Doctor's Calendar";
function generateCalendar($schedules, $month, $year, $isMini = false) {
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $occupiedDates = [];
    foreach ($schedules as $schedule) {
        $occupiedDates[$schedule['date']] = true;
    }

    $calendarClass = $isMini ? 'calendar-container mini' : 'calendar-container';
    ?>

    <div class="<?= $calendarClass ?>">
        <div class="calendar-nav">
            <a href="?month=<?= $month == 1 ? 12 : $month - 1; ?>&year=<?= $month == 1 ? $year - 1 : $year; ?>" class="nav-btn">&#9665;</a>
            <h3><?= date('F Y', mktime(0, 0, 0, $month, 1, $year)) ?></h3>
            <a href="?month=<?= $month == 12 ? 1 : $month + 1; ?>&year=<?= $month == 12 ? $year + 1 : $year; ?>" class="nav-btn">&#9655;</a>
        </div>
        <div class="calendar">
        <?php 
        $today = date('Y-m-d');

        // Group schedules by date
        $dateSchedules = [];
        foreach ($schedules as $schedule) {
            $dateSchedules[$schedule['date']][] = $schedule;
        }

        for ($day = 1; $day <= $daysInMonth; $day++): 
            $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
            $isOccupied = isset($dateSchedules[$date]);
            $isToday = ($date === $today);

            $classes = 'day';
            if ($isOccupied) $classes .= ' occupied';
            if ($isToday) $classes .= ' today';

            // Build tooltip text
            $tooltip = '';
            if ($isOccupied) {
                foreach ($dateSchedules[$date] as $slot) {
                    $start = date('gA', strtotime($slot['start_time'])); // 1PM
                    $end = date('gA', strtotime($slot['end_time']));     // 4PM
                    $appointments = $slot['filled_slots'];
                    $tooltip .= "$start - $end: $appointments appointments\n";
                }
                $tooltip = trim($tooltip);
            }
        ?>
            <a href="#" class="<?= $classes ?>" data-tooltip="<?= htmlspecialchars($tooltip) ?>">
                <?= $day ?>
            </a>
        <?php endfor; ?>
        </div>
    </div>
    <?php
}
?>
