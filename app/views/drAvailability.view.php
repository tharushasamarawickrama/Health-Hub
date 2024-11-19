<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';
?>
    <div class="container">
        <div class="left-section">
            <h3>Selected Timeslots</h3>
            <div class="selected-slots"></div>
            <button class="confirm-btn">Confirm</button>
        </div>
        <div class="right-section">
            <h3>Select Timeslots</h3>
            <p>(Only the unoccupied slots are selectable)</p>
            <div class="timeslot-container"></div>
        </div>
    </div>
    <?php require APPROOT . '/views/Components/footer.php'; ?>
<script src="<?php echo URLROOT; ?>/assets/js/drMedicalHistory.js"></script>