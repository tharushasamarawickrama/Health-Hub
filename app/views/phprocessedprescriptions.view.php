<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/phNavbar.php'; ?>

    <div class="processed-content">
    <!-- Calendar Section - Left Side -->
    <div class="calendar-container">
    <div id="calendar-header">
        <button id="prevMonth" class="month-nav">&lt;</button>
        <h2 id="currentMonth"></h2>
        <button id="nextMonth" class="month-nav">&gt;</button>
    </div>
    <div id="calendarDates" class="calendar-dates"></div>
</div>

    <!-- Appointments Section - Right Side -->
    <div class="appointments-container">
        <a href="<?php echo URLROOT; ?>/phprocessedappointment" class="ppresult-item">
        <div class="appointment-card">
            <p class="appointment-id">Appointment ID: 4565</p>
            <p>NIC: 200213288759</p>
        </div></a>
        <div class="appointment-card">
            <p class="appointment-id">Appointment ID: 4566</p>
            <p>NIC: 200213288760</p>
        </div>
        <div class="appointment-card">
            <p class="appointment-id">Appointment ID: 4567</p>
            <p>NIC: 200213273709</p>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT;?>/assets/js/PhProcessedPrescriptions.js"></script>