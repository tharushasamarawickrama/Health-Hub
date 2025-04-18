<?php

require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

$month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

$title = "Doctor's Calendar";

function generateCalendar($schedules, $month, $year) {
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $occupiedDates = [];
    foreach ($schedules as $schedule) {
        $occupiedDates[$schedule['date']] = true;
    }
    ?>

    <link rel="stylesheet" href="<?URLROOT ?>assets/css/pages/drCalendar.css">

    <div class="calendar-container">
        <div class="calendar-nav">
            <a href="?month=<?= $month == 1 ? 12 : $month - 1; ?>&year=<?= $month == 1 ? $year - 1 : $year; ?>" class="nav-btn">&#9665;</a>
            <h3><?= date('F Y', mktime(0, 0, 0, $month, 1, $year)) ?></h3>
            <a href="?month=<?= $month == 12 ? 1 : $month + 1; ?>&year=<?= $month == 12 ? $year + 1 : $year; ?>" class="nav-btn">&#9655;</a>
        </div>
        <div class="calendar">
            <?php for ($day = 1; $day <= $daysInMonth; $day++): 
                $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
                $isOccupied = isset($occupiedDates[$date]);
            ?>
                <a href="#" class="day <?= $isOccupied ? 'occupied' : '' ?>">
                    <?= $day ?>
                </a>
            <?php endfor; ?>
        </div>
    </div>

    <?php
}
generateCalendar($schedules, $month, $year);
?>
