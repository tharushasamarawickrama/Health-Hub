<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

// Define available times for each day
$timeSlotsPerDay = [
    "8AM - 11AM",
    "4PM - 7PM",
    "12PM - 2PM"
];

// Generate the upcoming 12 days (two 6-day weeks)
$allDates = [];
for ($i = 0; $i < 14; $i++) {
    $date = new DateTime();
    $date->modify("+$i day");
    $allDates[] = $date->format("d/m/Y");
}

// Initialize selected slots
// $fetchedTimeslots = [
//     ["25/01/2025", "8AM - 11AM"],
//     ["29/01/2025", "4PM - 7PM"]
// ];
?>

<div class="unique-availability-container">
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
                <button class="unique-clear-btn" onclick="clearUniqueTimeslots()">Clear</button>
                <button class="unique-save-btn" onclick="saveUniqueTimeslots()">Save</button>
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
    const allDates = <?php echo json_encode($allDates); ?>;
    const timeSlotsPerDay = <?php echo json_encode($timeSlotsPerDay); ?>;
    const selectedTimeslots = <?php echo json_encode($fetchedTimeslots); ?>;
</script>
<script src="<?php echo URLROOT; ?>js/drAvailability2.js?v=<?php echo time(); ?>"></script>

<?php require APPROOT . '/views/Components/footer.php'; ?>
