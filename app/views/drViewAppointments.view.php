<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

// Define appointment data for filters
$filter = $_GET['filter'] ?? 'all';
$dateFilter = $_GET['date'] ?? null;

$appointments = $data['allAppointments'];
if ($filter === 'today') {
    $appointments = $data['todaysAppointments'];
} elseif ($filter === 'upcoming') {
    $appointments = $data['upcomingAppointments'];
} elseif ($filter === 'past') {
    $appointments = $data['pastAppointments'];
}

if ($dateFilter) {
    $appointments = array_filter($appointments, function ($appointment) use ($dateFilter) {
        return $appointment['date'] === $dateFilter;
    });
}

$appointmentsPerPage = 5;
$totalAppointments = count($appointments);
$totalPages = ceil($totalAppointments / $appointmentsPerPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($currentPage - 1) * $appointmentsPerPage;
$paginatedAppointments = array_slice($appointments, $startIndex, $appointmentsPerPage);
?>

<div class="dr-view-appointments-container">
    <div class="dr-view-appointments-header">
        <a href="<?php echo URLROOT; ?>drDashboard">
            <img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="back-arrow" class="view-appointments-back-arrow">
        </a>
        <h2>Appointments</h2>
    </div>
    <div class="appointment-filters">
        <form method="GET">
            <label><input type="date" name="date" class="view-appointments-date" value="<?= $dateFilter ?? '' ?>"></label>
            <input type="radio" name="filter" value="all" id="all" <?= $filter === 'all' ? 'checked' : '' ?>>
            <label for="all">All</label>
            <input type="radio" name="filter" value="today" id="today" <?= $filter === 'today' ? 'checked' : '' ?>>
            <label for="today">Today</label>
            <input type="radio" name="filter" value="upcoming" id="upcoming" <?= $filter === 'upcoming' ? 'checked' : '' ?>>
            <label for="upcoming">Upcoming</label>
            <input type="radio" name="filter" value="past" id="past" <?= $filter === 'past' ? 'checked' : '' ?>>
            <label for="past">Past</label>
            <button type="submit">Filter</button>
        </form>
    </div>

    <!-- Appointments List -->
    <div class="view-appointments-list">
        <?php if (!empty($paginatedAppointments)): ?>
            <?php foreach ($paginatedAppointments as $appointment): ?>
                <div class="view-appointment-card">
                    <a href="<?php echo URLROOT; ?>drAppointment?appointment_id=<?= $appointment['id']; ?>" class="card-link">
                        <span class="appointment-id"><?= '#' . str_pad($appointment['id'], 4, '0', STR_PAD_LEFT) ?></span>
                        <span class="appointment-name"><?= $appointment['name'] ?></span>
                    </a>
                    <div class="appointment-action-icons">
                        <a href="#"><img src="<?php echo URLROOT; ?>assets/images/check-black.png" alt="Check Icon" class="appointment-check-icon"></a>
                        <a href="#"><img src="<?php echo URLROOT; ?>assets/images/xmark-black.png" alt="Cross Icon" class="appointment-check-icon"></a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No appointments found for the selected criteria.</p>
        <?php endif; ?>
    </div>

    <!-- Pagination Controls -->
    <div class="view-appointment-pagination">
        <?php if ($currentPage > 1): ?>
            <a href="?filter=<?= $filter ?>&date=<?= $dateFilter ?>&page=<?= $currentPage - 1 ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?filter=<?= $filter ?>&date=<?= $dateFilter ?>&page=<?= $i ?>" class="<?= $i == $currentPage ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?filter=<?= $filter ?>&date=<?= $dateFilter ?>&page=<?= $currentPage + 1 ?>">Next</a>
        <?php endif; ?>
    </div>
</div>
