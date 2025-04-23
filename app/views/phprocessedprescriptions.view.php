<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/phNavbar.php'; ?>
<div class="ph-pp-container">
    <div class="ph-pp-content">
    <!-- Calendar Section - Left Side -->
        <div class="ph-pp-calendar-container">
            <div id="ph-pp-calendar-header">
                <button id="ph-pp-prevMonth" class="ph-pp-month-nav">&lt;</button>
                <h2 id="ph-pp-currentMonth"></h2>
                <button id="ph-pp-nextMonth" class="ph-pp-month-nav">&gt;</button>
            </div>
        <div id="ph-pp-weekdays" class="ph-pp-calendar-weekdays">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>
        <div id="ph-pp-calendarDates" class="ph-pp-calendar-dates"></div>
    </div>

    <!-- Appointments Section - Right Side -->
    <div class="ph-pp-appointments-container">
        <div id="appointments-container">

            <?php if (!empty($data['appointments'])): ?>
            <?php foreach ($data['appointments'] as $appointment): ?>

                <a href="<?php echo URLROOT; ?>/phprocessedappointment?appointment_id=<?php echo $appointment['appointment_id']; ?>" class="ph-pp-result-item">
                <div class="ph-pp-appointment-card">
                    <div class="ph-pp-appointment-id">Appointment ID: <?php echo $appointment['appointment_id'];?></div>
                    <div>NIC: <?php echo $appointment['nic']; ?></div>
                </div>
                </a>
            <?php endforeach; ?>
            <?php else: ?>
                <div class="no-appointments">No completed appointments found</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/Components/footer.php'; ?>
<script>
    const URLROOT = "<?php echo URLROOT; ?>";
</script>
<script src="<?php echo URLROOT;?>/assets/js/PhProcessedPrescriptions.js"></script>