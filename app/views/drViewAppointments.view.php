<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';


$appointments = [
    ["id" => "#0001", "name" => "Mr. G. Peiris"],
    ["id" => "#0002", "name" => "Mr. Asitha Perera"],
    ["id" => "#0003", "name" => "Mrs. Malithi Fonseka"],
    ["id" => "#0004", "name" => "Mrs. Raveesha de Silva"],
    ["id" => "#0005", "name" => "Mrs. Himashi Liyanage"],
    ["id" => "#0006", "name" => "Mrs. Ruwani Perera"],
];

$appointmentsPerPage = 5;
$totalAppointments = count($appointments);
$totalPages = ceil($totalAppointments / $appointmentsPerPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($currentPage - 1) * $appointmentsPerPage;
$paginatedAppointments = array_slice($appointments, $startIndex, $appointmentsPerPage);
?>
    <div class="dr-view-appointments-container">
    
        <div class="dr-view-appointments-header">
        <a href="#"><img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="arrow-back" class="arrow-back"></a>
            <label><input type="date" class="date" id="dateInput"></label>
            <div class="appointment-filters">
                <input type="radio" name="filter" id="all" checked>
                <label for="all">All</label>
                <input type="radio" name="filter" id="upcoming">
                <label for="upcoming">Upcoming</label>
                <input type="radio" name="filter" id="past">
                <label for="past">Past</label>
            </div>
            <div>
                <input type="text" placeholder="Search" class="appointment-search-bar">
            </div>
        </div>

        <!-- Appointments List -->
        <div class="view-appointments-list">
            <?php foreach ($paginatedAppointments as $appointment): ?>
                <div class="view-appointment-card">
                    <span class="appointment-id"><?= $appointment['id'] ?></span>
                    <span class="appointment-name"><?= $appointment['name'] ?></span>
                    <span class="action-icons">
                        <a href="#"><img src="<?php echo URLROOT; ?>/assets/images/check-black.png" alt="Check Icon" class="appointment-check-icon"></a> <!-- Placeholder for Check Icon -->
                        <a href="#"><img src="<?php echo URLROOT; ?>/assets/images/xmark-black.png" alt="Check Icon" class="appointment-check-icon" alt="Cross Icon"></a> <!-- Placeholder for Cross Icon -->
                    </span>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination Controls -->
        <div class="view-appointment-pagination">
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="<?= $i == $currentPage ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dateInput = document.getElementById("dateInput");
            const today = new Date().toISOString().split('T')[0];
            dateInput.value = today;
        });
    </script>

<?php require APPROOT . '/views/Components/footer.php' ?>