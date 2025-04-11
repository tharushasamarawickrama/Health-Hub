<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/labNavbar.php'; ?>
<div class="lab-proc-container">
    <div class="lab-proc-content">
    <!-- Calendar Section - Left Side -->
    <div class="lab-proc-calendar-container">
    <div id="lab-proc-calendar-header">
        <button id="lab-proc-prevMonth" class="lab-proc-month-nav">&lt;</button>
        <h2 id="lab-proc-currentMonth"></h2>
        <button id="lab-proc-nextMonth" class="lab-proc-month-nav">&gt;</button>
    </div>
    <div id="lab-proc-weekdays" class="lab-proc-calendar-weekdays">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>
    <div id="lab-proc-calendarDates" class="lab-proc-calendar-dates"></div>

</div>

    <!-- Appointments Section - Right Side -->
    <div class="lab-proc-appointments-container" id="appointments-container">
    <?php if (!empty($data['appointments'])): ?>
        <?php foreach ($data['appointments'] as $appointment): ?>
            <a href="<?php echo URLROOT; ?>/labprocessedappointment?appointment_id=<?php echo $appointment['appointment_id']; ?>" class="lab-proc-result-item">
                <div class="lab-proc-appointment-card">
                    <div class="lab-proc-appointment-id">Appointment ID: <?php echo $appointment['appointment_id']; ?></div>
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
<script src="<?php echo URLROOT;?>/assets/js/LabProcessedPrescriptions.js"></script>

