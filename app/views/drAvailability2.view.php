<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';
?>

<div class="unique-availability-container">
    <!-- Toast Notification -->
    <div id="toast" class="toast-message">
        <img src="<?php echo URLROOT; ?>assets/images/check-green.png" alt="Success" class="toast-icon"> 
        <span id="toast-text"></span>
    </div>

    <div class="unique-availability-header">
        <a href="<?php echo URLROOT; ?>drSchedules" class="unique-back-arrow">
            <img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back">
        </a>
        <h3>Selected Timeslots</h3>
        <h3 class="unique-select-timeslots">Select Timeslots</h3>
    </div>

    <div class="unique-timeslots-container">
        <!-- Left section: Selected timeslots -->
        <div class="unique-left-section">
            <div id="unique-selected-timeslots" class="unique-selected-slots">
                <?php if(!empty($occupiedSlots)): ?>
                <?php foreach ($occupiedSlots as $slot): ?>
                    <?php 
                        $display = $slot[0] . ' - ' . $slot[1];
                        $value = htmlspecialchars(json_encode($slot)); // store original format safely
                    ?>
                    <div class="unique-timeslot-tag" data-value='<?= $value ?>'>
                        <?= $display ?>
                        <span class="unique-remove-btn" onclick="removeSlot(this)">✖</span>
                    </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <p>No timeslots selected.</p>
                <?php endif; ?>
            </div>

            <div class="unique-actions">
                <form id="unique-timeslot-form" method="POST" action="<?php echo URLROOT ?>drAvailability2">
                    <input type="hidden" name="selectedTimeslots" id="selectedTimeslotsInput">
                    <input type="hidden" name="originalOccupiedSlots" id="originalOccupiedSlotsInput" value='<?php echo htmlspecialchars(json_encode($occupiedSlots)); ?>'>
                    <button type="button" class="unique-clear-btn" onclick="clearUniqueTimeslots()">Clear</button>
                    <button type="submit" class="unique-save-btn" onclick="saveUniqueTimeslots()">Save</button>
                </form>
            </div>
        </div>

        <!-- Right section: Doctor slots + optional slots -->

        <div id="unique-options" class="unique-options">
            <!-- Doctor's available slots -->
            <div class="unique-slot-group">
            <h4>Your Weekly Slots</h4>
            <?php if (!empty($doctorSlots)): ?>
                    <?php foreach ($doctorSlots as $slot): ?>
                        <?php 
                            $display = $slot[0] . ' - ' . $slot[1];
                            $value = htmlspecialchars(json_encode($slot));
                        ?>
                        <div class="unique-slot-btn" data-value='<?= $value ?>' onclick="toggleSlot(this)">
                            <?= $display ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No slots available.</p>  
            <?php endif; ?>
            </div>

            <!-- Optional system-generated slots -->
            <div class="unique-slot-group">
            <h4>Suggested Optional Slots</h4>
            <?php if (!empty($optionalSlots)): ?>
                    <?php foreach ($optionalSlots as $slot): ?>
                        <?php 
                            $display = $slot[0] . ' - ' . $slot[1];
                            $value = htmlspecialchars(json_encode($slot));
                        ?>
                        <div class="unique-slot-btn optional-slot" data-value='<?= $value ?>' onclick="toggleSlot(this)">
                            <?= $display ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No optional slots available.</p>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
    const successMessage = "<?php echo $_SESSION['success_message'] ?? ''; ?>";
</script>
<script src="<?php echo URLROOT; ?>js/drAvailability2.js?v=<?php echo time(); ?>"></script>
<?php unset($_SESSION['success_message']); ?>
<?php require APPROOT . '/views/Components/footer.php'; ?>
