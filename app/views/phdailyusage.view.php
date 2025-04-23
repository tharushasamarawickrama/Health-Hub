<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/phNavbar.php'; ?>
<div class="ph-usage-content">
    <div class="ph-usage-calendar-container">
        <div id="ph-usage-calendar-header">
            <button id="ph-usage-prevMonth" class="ph-usage-month-nav">&lt;</button>
            <h2 id="ph-usage-currentMonth"></h2>
            <button id="ph-usage-nextMonth" class="ph-usage-month-nav">&gt;</button>
        </div>
        <div id="ph-usage-weekdays" class="ph-usage-calendar-weekdays">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>
        <div id="ph-usage-calendarDates" class="ph-usage-calendar-dates"></div>
    </div>
</div>
<script>
    const URLROOT = "<?php echo URLROOT; ?>";
</script>
<?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT;?>/assets/js/PhDailyUsage.js"></script>