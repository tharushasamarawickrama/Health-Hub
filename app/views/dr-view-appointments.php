<?php

define('URLROOT', 'http://localhost/healthHub');

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/css/fonts.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/css/dr-view-appointments.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php
        include 'Components/dr-navbar.php';
    ?>
    <div class="container">
    
        <div class="header">
        <a href="#"><img src="<?php echo URLROOT; ?>/public/assets/images/arrow-back.png" alt="arrow-back" class="arrow-back"></a>
            <label><input type="date" class="date" id="dateInput"></label>
            <div class="filters">
                <input type="radio" name="filter" id="all" checked>
                <label for="all">All</label>
                <input type="radio" name="filter" id="upcoming">
                <label for="upcoming">Upcoming</label>
                <input type="radio" name="filter" id="past">
                <label for="past">Past</label>
            </div>
            <div class="searc-bar">
                <input type="text" placeholder="Search" class="search-bar">
            </div>
        </div>

        <!-- Appointments List -->
        <div class="appointments-list">
            <?php foreach ($paginatedAppointments as $appointment): ?>
                <div class="appointment-card">
                    <span class="appointment-id"><?= $appointment['id'] ?></span>
                    <span class="appointment-name"><?= $appointment['name'] ?></span>
                    <span class="action-icons">
                        <a href="#"><img src="<?php echo URLROOT; ?>/public/assets/images/check-black.png" alt="Check Icon" class="check-icon"></a> <!-- Placeholder for Check Icon -->
                        <a href="#"><img src="<?php echo URLROOT; ?>/public/assets/images/xmark-black.png" alt="Check Icon" class="check-icon" alt="Cross Icon"></a> <!-- Placeholder for Cross Icon -->
                    </span>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination Controls -->
        <div class="pagination">
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
</body>
</html>
