<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';
?>

<div class="dr-availability-container">
    <div class="dr-availability-header">
        <a href="<?php echo URLROOT; ?>drDashboard" class="availability-back-arrow">
            <img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back">
        </a>
        <h3>Selected Timeslots</h3>
        <h3>Select Timeslots</h3>
    </div>

    <div class="timeslots-container">
        <div class="availability-left-section">
            <div id="selected-timeslots" class="selected-slots-display">
                <?php if (!empty($data['fetchedTimeslots'])): ?>
                    <?php foreach ($data['fetchedTimeslots'] as $timeslot): ?>
                        <span class="timeslot-tag">
                            <?php echo htmlspecialchars($timeslot); ?>
                            <button class="timeslot-remove-btn" data-timeslot="<?php echo htmlspecialchars($timeslot); ?>">×</button>
                        </span>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p id="no-slots-msg">No timeslots selected.</p>
                <?php endif; ?>
            </div>
            <div class="timeslot-actions">
                <form method="POST" action="<?php echo URLROOT; ?>drAvailability">
                    <input type="hidden" name="selectedTimeslots" id="selectedTimeslotsInput">
                    <button type="button" class="timeslot-button-clear" onclick="clearTimeslots()">Clear</button>
                    <button type="submit" class="timeslot-button-save" onclick="prepareSave()">Save</button>
                </form>
            </div>
        </div>

        <div class="timeslot-options">
            <?php foreach ($data['allTimeslots'] as $timeslot): ?>
                <button 
                    class="timeslot-button <?php echo in_array($timeslot, $data['occupiedTimeslots']) ? 'disabled' : ''; ?>" 
                    onclick="addTimeslot('<?php echo addslashes(str_replace(["\n", "\r"], " ", htmlspecialchars($timeslot))); ?>', this)" 
                    <?php echo in_array($timeslot, $data['occupiedTimeslots']) ? 'disabled' : ''; ?>>
                    <?php echo nl2br(htmlspecialchars($timeslot)); ?>
                </button>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<script>
    // Initialize the selected timeslots from PHP
    const selectedTimeslots = <?php 
        $cleanedTimeslots = array_map(function($timeslot) {
            return str_replace("\n", " ", $timeslot); // Replace newlines with space
        }, $data['fetchedTimeslots']);
        echo json_encode($cleanedTimeslots);
    ?>;
</script>
<script src="<?php echo URLROOT; ?>js/drAvailability.js?v=<?php echo time(); ?>"></script>
<?php require APPROOT . '/views/Components/footer.php'; ?>
