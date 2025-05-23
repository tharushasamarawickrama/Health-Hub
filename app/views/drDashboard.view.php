<?php 
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';
require APPROOT . '/views/Components/drCalendarComponent.php';

$numberOfAppointmentsToday = count($appointmentsToday);
?>

<div class="dr-dashboard">
    <div class="dashboard-layout">
        <!-- Left Section -->
        <div class="left-section">
            <div class="dashboard-info">
                <div class="appointments-today">
                    <img src="<?php echo URLROOT; ?>assets/images/appointments.png" alt="appointments" class="appointments-icon">
                    <h3><?php echo $numberOfAppointmentsToday; ?> Appointments for Today</h3>
                </div>
                <?php if($doctorType == 'specialist'): ?>
                <div class="todays-slots">
                    <h3>Today's Slots</h3>
                    <?php if($todaysSlots): ?>
                    <ul id="slotsList">
                        <?php foreach ($todaysSlots as $slot): ?>
                            <li style="font-family: monospace; white-space: pre;"><?php echo 
                                date("gA", strtotime($slot["start_time"])) . " - " . 
                                date("gA", strtotime($slot["end_time"])) . 
                                "\t=>    " . $slot["filled_slots"] . " appointments"; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php else: ?>
                        <p>No slots available for today.</p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
            </div>

            <div class="appointments-list">
                <h3>Today's Appointments</h3>
                <div class="appointments-container">
                    <ul id="appointmentsList">
                        <?php foreach ($appointmentsToday as $appointment): ?>
                            <li><?php echo $appointment["id"] . " - " . $appointment["name"]; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php if (count($appointmentsToday) > 4): ?>
                        <div class="scroll-controls">
                            <button id="prevBtn">&lt;</button>
                            <button id="nextBtn">&gt;</button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <div>
            <div class="mini-calendar-wrapper">
                <h3>Schedule Overview</h3>
                <?php generateCalendar($schedules, $month, $year, true); ?>
            </div>
            </div>
            <div class="appointments-chart">
                <h3>Appointments in the Past Few Slots</h3>
                <canvas id="appointmentsChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const appointmentsList = document.getElementById('appointmentsList');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    let scrollIndex = 0;

    if (appointmentsList && prevBtn && nextBtn) {
        const scrollStep = 4;
        const totalItems = <?php echo count($appointmentsToday); ?>;
        const totalPages = Math.ceil(totalItems / scrollStep);

        function updateScroll(direction) {
            scrollIndex = Math.max(0, Math.min(totalPages - 1, scrollIndex + direction));
            const start = scrollIndex * scrollStep;
            const end = start + scrollStep;
            const items = appointmentsList.querySelectorAll('li');
            items.forEach((item, index) => {
                item.style.display = index >= start && index < end ? 'block' : 'none';
            });
        }

        prevBtn.addEventListener('click', () => updateScroll(-1));
        nextBtn.addEventListener('click', () => updateScroll(1));

        updateScroll(0); // Initialize
    }

    // Data for the bar chart
    const chartLabels = <?php echo json_encode(array_keys($pastAppointments)); ?>;
    const chartData = <?php echo json_encode(array_values($pastAppointments)); ?>;

    const ctx = document.getElementById('appointmentsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Number of Appointments',
                data: chartData,
                backgroundColor: '#898989', // Bar color
                borderColor: '#000000',    // Border color
                borderWidth: 1,
                barThickness: 55           // Bar thickness
            }],
        },
        options: {
            scales: {
                x: {
                    ticks: {
                        color: '#000000',   // Black text for labels
                        minRotation: 0,     // Force horizontal text
                        maxRotation: 10,     // Prevent diagonal rotation
                    },
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#000000',   // Black text for labels
                    },
                },
            },
        },
    });
</script>






<?php require APPROOT . '/views/Components/footer.php'; ?>
