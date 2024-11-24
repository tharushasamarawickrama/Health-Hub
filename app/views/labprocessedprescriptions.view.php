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
    <div class="lab-proc-appointments-container">
        <a href="<?php echo URLROOT; ?>/labprocessedappointment" class="lab-proc-result-item">
        <div class="lab-proc-appointment-card">
            01.
            <p class="lab-proc-appointment-id">Appointment ID: 4565</p>
            <p>NIC: 200213288759</p>
        </div></a>
        <div class="lab-proc-appointment-card">
            02.
            <p class="lab-proc-appointment-id">Appointment ID: 4566</p>
            <p>NIC: 200213288760</p>
        </div>
        <div class="lab-proc-appointment-card">
            03.
            <p class="lab-proc-ppointment-id">Appointment ID: 4567</p>
            <p>NIC: 200213273709</p>
        </div>
    </div>
</div>
</div>
<?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT;?>/assets/js/LabProcessedPrescriptions.js"></script>