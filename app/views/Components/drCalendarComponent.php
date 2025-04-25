<?php

$month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

$title = "Doctor's Calendar";

function generateCalendar($schedules, $month, $year, $isMini = false) {
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    $calendarClass = $isMini ? 'calendar-container mini' : 'calendar-container';
    ?>

    <div class="<?= $calendarClass ?>">
        <div class="calendar-nav">
            <a href="?month=<?= $month == 1 ? 12 : $month - 1; ?>&year=<?= $month == 1 ? $year - 1 : $year; ?>" class="nav-btn">&#9665;</a>
            <h3><?= date('F Y', mktime(0, 0, 0, $month, 1, $year)) ?></h3>
            <a href="?month=<?= $month == 12 ? 1 : $month + 1; ?>&year=<?= $month == 12 ? $year + 1 : $year; ?>" class="nav-btn">&#9655;</a>
        </div>

        <div class="calendar">
            <!-- Weekday Names -->
            <?php
            $dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            foreach ($dayNames as $dayName) {
                echo "<div class='day-name'>$dayName</div>";
            }

            $today = date('Y-m-d');

            // Group schedules by date
            $dateSchedules = [];
            foreach ($schedules as $schedule) {
                $dateSchedules[$schedule['date']][] = $schedule;
            }

            // Add empty blocks for offset
            $firstDayOfWeek = date('w', strtotime("$year-$month-01"));
            for ($blank = 0; $blank < $firstDayOfWeek; $blank++) {
                echo "<div class='day empty'></div>";
            }

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
                $isOccupied = isset($dateSchedules[$date]);
                $isToday = ($date === $today);

                $classes = 'day';
                if ($isOccupied) $classes .= ' occupied';
                if ($isToday) $classes .= ' today';

                $tooltip = '';
                if ($isOccupied) {
                    foreach ($dateSchedules[$date] as $slot) {
                        $start = date('gA', strtotime($slot['start_time']));
                        $end = date('gA', strtotime($slot['end_time']));
                        $appointments = $slot['filled_slots'];
                        $tooltip .= "$start - $end: $appointments appointments\n";
                    }
                    $tooltip = trim($tooltip);
                }

                echo "<a href='#' class='$classes' data-tooltip=\"" . htmlspecialchars($tooltip) . "\">$day</a>";
            }
            ?>
        </div>
    </div>
    <?php
}
?>
