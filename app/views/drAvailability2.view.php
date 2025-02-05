<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

// Define available times for each day
$timeSlotsPerDay = [
    "8AM - 11AM",
    "1PM - 4PM",
    "4PM - 7PM"
];

// Generate the next 14 days from this Monday
$allDates = [];
for ($i = 0; $i < 14; $i++) {
    $date = clone $startDate;
    $date->modify("+$i day");
    $allDates[] = $date->format("d/m/Y");
}

?>

<div class="unique-availability-container">
    <!-- Toast Notification -->
    <div id="toast" class="toast-message">
        <img src="<?php echo URLROOT; ?>assets/images/check-green.png" alt="Success" class="toast-icon"> 
        <span id="toast-text"></span>
    </div>
    <div class="unique-availability-header">
        <a href="<?php echo URLROOT; ?>drDashboard" class="unique-back-arrow">
            <img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back">
        </a>
        <h3>Selected Timeslots</h3>
        <h3 class="unique-select-timeslots">Select Timeslots</h3>
    </div>

    <div class="unique-timeslots-container">
        <div class="unique-left-section">
            <div id="unique-selected-timeslots" class="unique-selected-slots">
                <?php if (!empty($fetchedTimeslots)): ?>
                    <?php foreach ($fetchedTimeslots as $timeslot): ?>
                        <span class="unique-timeslot-tag">
                            <?php echo htmlspecialchars($timeslot[0]) . " " . htmlspecialchars($timeslot[1]); ?>
                            <button class="unique-remove-btn" onclick="removeUniqueTimeslot('<?php echo htmlspecialchars($timeslot[0]); ?>', '<?php echo htmlspecialchars($timeslot[1]); ?>')">&times;</button>
                        </span>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p id="unique-no-slots-msg">No timeslots selected.</p>
                <?php endif; ?>
            </div>
            <div class="unique-actions">
                <form id="unique-timeslot-form" method="POST" action="<?php echo URLROOT?>drAvailability2">
                    <input type="hidden" name="selectedTimeslots" id="selectedTimeslotsInput">
                    <button type="button" class="unique-clear-btn" onclick="clearUniqueTimeslots()">Clear</button>
                    <button type="submit" class="unique-save-btn" onclick="saveUniqueTimeslots()">Save</button>
                </form>
            </div>
        </div>

        <div class="unique-header">
            <button id="unique-prev-week" onclick="changeUniqueWeek(-1)" disabled>← Previous</button>
            <h3 id="unique-week-range-title"></h3>
            <button id="unique-next-week" onclick="changeUniqueWeek(1)">Next →</button>
        </div>

        <div id="unique-options" class="unique-options">
            <!-- Slots will be dynamically populated by JavaScript -->
        </div>
    </div>
</div>
<script>
    var successMessage = "<?= $_SESSION['success_message'] ?? '' ?>";
    const allDates = <?php echo json_encode($allDates); ?>;
    const timeSlotsPerDay = <?php echo json_encode($timeSlotsPerDay); ?>;
    const selectedTimeslots = <?php echo json_encode($fetchedTimeslots); ?>;
    const occupiedTimeslots = <?php echo json_encode($occupiedTimeslots); ?>;
</script>
<script src="<?php echo URLROOT; ?>js/drAvailability2.js?v=<?php echo time(); ?>"></script>
<?php unset($_SESSION['success_message']); ?>

<?php require APPROOT . '/views/Components/footer.php'; ?>
