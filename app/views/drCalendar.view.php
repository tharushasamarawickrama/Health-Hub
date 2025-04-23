<?php

require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';
require APPROOT . '/views/Components/drCalendarComponent.php';


generateCalendar($schedules, $month, $year);
?>
