<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/phNavbar.php'; ?>

    <div class="lab-pp-content">
    <!-- Calendar Section - Left Side -->
        <div class="lab-pp-calendar-container">
            <div id="lab-pp-calendar-header">
                <button id="lab-pp-prevMonth" class="lab-pp-month-nav">&lt;</button>
                <h2 id="lab-pp-currentMonth"></h2>
                <button id="lab-pp-nextMonth" class="lab-pp-month-nav">&gt;</button>
            </div>
            <div id="lab-pp-weekdays" class="lab-pp-calendar-weekdays">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>
        <div id="lab-pp-calendarDates" class="lab-pp-calendar-dates"></div>
    </div>

    <!-- Appointments Section - Right Side -->
    <div class="lab-pp-appappointments-container">
        
        <div class="lab-pp-card">
            <p>Appointment ID : 3465</p>
            <p>NIC : 200397482759</p>
            <a href="<?php echo URLROOT; ?>/Labprocessedappointment" class="lab-pp-result-item">
            <button class="lab-pp-view-btn">View</button></a>
        </div>
        <div class="lab-pp-card">
            <p>Appointment ID : 8765</p>
            <p>NIC : 2001132688659</p>
            <button class="lab-pp-view-btn">View</button>
        </div>
        <div class="lab-pp-card">
            <p>Appointment ID : 2398</p>
            <p>NIC : 200254302856</p>
            <button class="lab-pp-view-btn">View</button>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT;?>/assets/js/PhProcessedPrescriptions.js"></script>