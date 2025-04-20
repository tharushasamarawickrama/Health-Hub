<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

date_default_timezone_set('Asia/Colombo');

// to treat the same date selection as filter = today
$dateFilter = (isset($_GET['date']) && $_GET['date'] !== date('Y-m-d')) ? $_GET['date'] : null;

if (!isset($_GET['filter']) && !$dateFilter) {
    $filter = 'today';
} else {
    $filter = $_GET['filter'] ?? null;
}
$slotFilters = $_GET['slot'] ?? [];

$appointments = $data['allAppointments'];
if ($filter === 'today') {
    $slotFilters = [];
    $appointments = $data['todaysAppointments'];
} elseif ($filter === 'upcoming') {
    $appointments = $data['upcomingAppointments'];
}

if ($dateFilter) {
    $appointments = array_filter($appointments, function ($appointment) use ($dateFilter) {
        return $appointment['date'] === $dateFilter;
    });
}

if (!empty($slotFilters)) {
    $appointments = array_filter($appointments, function ($appointment) use ($slotFilters) {
        $hour = (int)date('G', strtotime($appointment['appointment_time']));
        foreach ($slotFilters as $slot) {
            if (
                ($slot === '8' && $hour >= 8 && $hour < 11) ||
                ($slot === '13' && $hour >= 13 && $hour < 16) ||
                ($slot === '16' && $hour >= 16 && $hour < 19)
            ) {
                return true;
            }
        }
        return false;
    });
}

$appointmentsPerPage = 4;
$totalAppointments = count($appointments);
$totalPages = ceil($totalAppointments / $appointmentsPerPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($currentPage - 1) * $appointmentsPerPage;
$paginatedAppointments = array_slice($appointments, $startIndex, $appointmentsPerPage);

$doctorType = $data['doctorType'];
$schedules = $data['schedules'];

$slotToShow = 0; // default to first if time doesn't match
if ($filter === 'today' && $doctorType === 'specialist') {
    $groupedAppointments = [];
    $remainingAppointments = $appointments;

    foreach ($schedules as $i => $schedule) {
        if ($schedule['date'] === date('Y-m-d')) {
            $slotLabel = date('gA', strtotime($schedule['start_time'])) . ' - ' . date('gA', strtotime($schedule['end_time']));
            $count = $schedule['filled_slots'];
            $slotAppointments = array_splice($remainingAppointments, 0, $count);

            $groupedAppointments[$slotLabel] = [
                'new' => array_filter($slotAppointments, fn($a) => $a['status'] === 'new'),
                'completed' => array_filter($slotAppointments, fn($a) => $a['status'] === 'completed'),
            ];

            $slotHour = (int)date('G', strtotime($schedule['start_time']));
            $currentHour = (int)date('G');
            if ($currentHour >= $slotHour && $currentHour < $slotHour + 3) {
                $slotToShow = $i;
            }
        }
    }
    if (isset($_GET['slotindex'])) {
        $slotToShow = (int)$_GET['slotindex'];
    }
    $appointmentStatusTab = $_GET['statusTab'] ?? 'new';
}
?>

<div class="dr-view-appointments-container">
    <!-- Toast Notification -->
    <div id="toast" class="toast-message">
        <img src="<?php echo URLROOT; ?>assets/images/check-green.png" alt="Success" class="toast-icon">
        <span id="toast-text"></span>
    </div>
    <div class="dr-view-appointments-header">
        <a href="<?= URLROOT; ?>drDashboard">
            <img src="<?= URLROOT; ?>assets/images/arrow-back.png" alt="back-arrow" class="view-appointments-back-arrow">
        </a>
        <h2>Appointments</h2>
    </div>

    <div class="appointment-filters">
        <form method="GET" id="filterForm">
            <label>
                <input type="date" name="date" class="view-appointments-date" id="datePicker" value="<?= $dateFilter ?? '' ?>">
            </label>

            <input type="radio" name="filter" value="today" id="today" <?= $filter === 'today' ? 'checked' : '' ?>>
            <label for="today">Today</label>

            <input type="radio" name="filter" value="upcoming" id="upcoming" <?= $filter === 'upcoming' ? 'checked' : '' ?>>
            <label for="upcoming">Upcoming</label>

            <?php if ($doctorType === 'specialist' && ($filter === 'upcoming' || $dateFilter)): ?>
                <div class="slot-checkboxes">
                    <label><input type="checkbox" name="slot[]" value="8" <?= (in_array('8', $slotFilters) || !$slotFilters) ? 'checked' : '' ?>> 8AM - 11AM</label>
                    <label><input type="checkbox" name="slot[]" value="13" <?= (in_array('13', $slotFilters) || !$slotFilters) ? 'checked' : '' ?>> 1PM - 4PM</label>
                    <label><input type="checkbox" name="slot[]" value="16" <?= (in_array('16', $slotFilters) || !$slotFilters) ? 'checked' : '' ?>> 4PM - 7PM</label>
                </div>
            <?php endif; ?>

            <button type="submit">Filter</button>
        </form>
    </div>

    <div class="view-appointments-list">
        <?php if ($filter === 'today' && $doctorType === 'specialist' && !$dateFilter): ?>
            <?php if (!empty($groupedAppointments)): ?>
                <div class="slot-tab-headings">
                    <?php $slotIndex = 0;
                    foreach ($groupedAppointments as $slot => $slotAppointments): ?>
                        <a href="?filter=<?= $filter ?>&slotindex=<?= $slotIndex ?>&slotpage=1" class="slot-tab-btn <?= $slotIndex === $slotToShow ? 'active' : '' ?>" data-slot="slot-<?= $slotIndex ?>"><?= $slot ?></a>
                    <?php $slotIndex++;
                    endforeach; ?>
                </div>

                <div class="slot-status-tabs">
                    <button class="status-tab-btn <?= $appointmentStatusTab === 'new' ? 'active' : '' ?>" data-status="new">New</button>
                    <button class="status-tab-btn <?= $appointmentStatusTab === 'completed' ? 'active' : '' ?>" data-status="completed">Completed</button>
                </div>

                <div class="slot-tab-contents">
                    <?php
                    $slotIndex = 0;
                    foreach ($groupedAppointments as $slot => $slotData):
                        foreach (['new', 'completed'] as $statusTab):
                            $appointmentsList = $slotData[$statusTab];
                            $totalPages = ceil(count($appointmentsList) / $appointmentsPerPage);
                            $currentSlotIndex = $_GET['slotindex'] ?? $slotToShow;
                            $slotPage = ($_GET['slotpage'] ?? 1);
                            $start = ($slotPage - 1) * $appointmentsPerPage;
                            $paginatedSlot = array_slice($appointmentsList, $start, $appointmentsPerPage);
                    ?>
                            <div class="slot-tab-content <?= $slotIndex == $slotToShow && $appointmentStatusTab === $statusTab ? 'active' : '' ?>"
                                id="slot-<?= $slotIndex ?>-<?= $statusTab ?>"
                                data-slot="<?= $slotIndex ?>" data-status="<?= $statusTab ?>">
                                <?php if (!empty($paginatedSlot)): ?>
                                    <?php foreach ($paginatedSlot as $appointment): ?>
                                        <div class="view-appointment-card" data-id="<?= $appointment['id'] ?>" data-status="<?= $appointment['status'] ?>">
                                            <a href="<?= URLROOT; ?>drAppointment?appointment_id=<?= $appointment['id']; ?>" class="card-link">
                                                <span class="appointment-id"><?= '#' . str_pad($appointment['appointment_No'], 4, '0', STR_PAD_LEFT) ?></span>
                                                <span class="appointment-name"><?= $appointment['name'] ?></span>
                                            </a>
                                            <div class="appointment-action-icons">
                                                <?php if ($appointment['status'] === 'new'): ?>
                                                    <a href="#" class="mark-complete" data-id="<?= $appointment['id'] ?>"><img src="<?= URLROOT; ?>assets/images/check-black.png" alt="Check Icon" class="appointment-check-icon"></a>
                                                <?php endif; ?>
                                                <a href="#"><img src="<?= URLROOT; ?>assets/images/xmark-black.png" alt="Cross Icon" class="appointment-check-icon"></a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>No <?= ucfirst($statusTab) ?> appointments in this time slot.</p>
                                <?php endif; ?>

                                <div class="view-appointment-pagination">
                                    <?php if ($slotPage > 1): ?>
                                        <a href="?filter=<?= $filter ?>&slotindex=<?= $slotIndex ?>&slotpage=<?= $slotPage - 1 ?>&statusTab=<?= $statusTab ?>">Previous</a>
                                    <?php endif; ?>
                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <a href="?filter=<?= $filter ?>&slotindex=<?= $slotIndex ?>&slotpage=<?= $i ?>&statusTab=<?= $statusTab ?>" class="<?= $i == $slotPage ? 'active' : '' ?>"><?= $i ?></a>
                                    <?php endfor; ?>
                                    <?php if ($slotPage < $totalPages): ?>
                                        <a href="?filter=<?= $filter ?>&slotindex=<?= $slotIndex ?>&slotpage=<?= $slotPage + 1 ?>&statusTab=<?= $statusTab ?>">Next</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                    <?php endforeach;
                        $slotIndex++;
                    endforeach; ?>
                </div>

            <?php else: ?>
                <p>No time slots found for today.</p>
            <?php endif; ?>
        <?php else: ?>
            <?php if (!empty($paginatedAppointments)): ?>
                <?php foreach ($paginatedAppointments as $appointment): ?>
                    <div class="view-appointment-card">
                        <a href="<?= URLROOT; ?>drAppointment?appointment_id=<?= $appointment['id']; ?>" class="card-link">
                            <div class="appointment-date"><?= date('d M Y', strtotime($appointment['date'])) ?></div>
                            <span class="appointment-id"><?= '#' . str_pad($appointment['appointment_No'], 4, '0', STR_PAD_LEFT) ?></span>
                            <span class="appointment-name"><?= $appointment['name'] ?></span>
                        </a>
                        <div class="appointment-action-icons">
                            <a href="#"><img src="<?= URLROOT; ?>assets/images/check-black.png" alt="Check Icon" class="appointment-check-icon"></a>
                            <a href="#"><img src="<?= URLROOT; ?>assets/images/xmark-black.png" alt="Cross Icon" class="appointment-check-icon"></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No appointments found for the selected criteria.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <?php if (!($filter === 'today' && $doctorType === 'specialist')): ?>
        <div class="view-appointment-pagination">
            <?php if ($currentPage > 1): ?>
                <a href="?<?= http_build_query(array_merge($_GET, ['page' => $currentPage - 1])) ?>">Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" class="<?= $i == $currentPage ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
            <?php if ($currentPage < $totalPages): ?>
                <a href="?<?= http_build_query(array_merge($_GET, ['page' => $currentPage + 1])) ?>">Next</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<script src="<?php echo URLROOT; ?>js/drViewAppointments.js?v=<?php echo time(); ?>"></script>