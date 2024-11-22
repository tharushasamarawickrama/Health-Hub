<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/phNavbar.php'; ?>

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
        <a href="<?php echo URLROOT; ?>/phprocessedappointment" class="ph-pp-result-item">
        <div class="ph-pp-appointment-card">
            <p class="ph-pp-appointment-id">Appointment ID: 4565</p>
            <p>NIC: 200213288759</p>
        </div></a>
        <div class="ph-pp-appointment-card">
            <p class="ph-pp-appointment-id">Appointment ID: 4566</p>
            <p>NIC: 200213288760</p>
        </div>
        <div class="ph-pp-appointment-card">
            <p class="ph-pp-appointment-id">Appointment ID: 4567</p>
            <p>NIC: 200213273709</p>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT;?>/assets/js/PhProcessedPrescriptions.js"></script>