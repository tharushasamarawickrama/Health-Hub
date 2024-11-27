//availability.view.php
<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

$fetchedTimeslots = ["14/10/2024 8AM - 5PM", "16/10/2024 8AM - 5PM"];
$allTimeslots = [
    "14/10/2024 8AM - 5PM",
    "15/10/2024 8AM - 5PM",
    "16/10/2024 8AM - 5PM",
    "17/10/2024 8AM - 5PM",
    "18/10/2024 8AM - 5PM",
    "19/10/2024 8AM - 5PM",
];
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
                <?php if (!empty($fetchedTimeslots)): ?>
                    <?php foreach ($fetchedTimeslots as $timeslot): ?>
                        <span class="timeslot-tag">
                            <?php echo htmlspecialchars($timeslot); ?>
                            <button class="timeslot-remove-btn" onclick="removeTimeslot('<?php echo htmlspecialchars($timeslot); ?>')">&times;</button>
                        </span>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p id="no-slots-msg">No timeslots selected.</p>
                <?php endif; ?>
            </div>
            <div class="timeslot-actions">
                <button class="timeslot-button" onclick="clearTimeslots()">Clear</button>
                <button class="timeslot-button" onclick="saveTimeslots()">Save</button>
            </div>
        </div>

        <div class="timeslot-options">
            <?php foreach ($allTimeslots as $timeslot): ?>
                <button 
                    class="timeslot-button <?php echo in_array($timeslot, $fetchedTimeslots) ? 'disabled' : ''; ?>" 
                    onclick="<?php echo in_array($timeslot, $fetchedTimeslots) ? '' : "addTimeslot('$timeslot')"; ?>"
                    <?php echo in_array($timeslot, $fetchedTimeslots) ? 'disabled' : ''; ?>>
                    <?php echo htmlspecialchars($timeslot); ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    const selectedTimeslots = <?php echo json_encode($fetchedTimeslots); ?>;

    function addTimeslot(slotName) {
        if (!selectedTimeslots.includes(slotName)) {
            selectedTimeslots.push(slotName);
            updateTimeslotDisplay();
        } else {
            alert(slotName + " is already selected.");
        }
    }

    function removeTimeslot(slotName) {
        const index = selectedTimeslots.indexOf(slotName);
        if (index > -1) {
            selectedTimeslots.splice(index, 1);
            updateTimeslotDisplay();
        }
    }

    function updateTimeslotDisplay() {
        const timeslotContainer = document.getElementById("selected-timeslots");
        timeslotContainer.innerHTML = "";

        if (selectedTimeslots.length === 0) {
            timeslotContainer.innerHTML = "<p id='no-slots-msg'>No timeslots selected.</p>";
            return;
        }

        selectedTimeslots.forEach(timeslot => {
            const timeslotTag = document.createElement("span");
            timeslotTag.className = "timeslot-tag";
            timeslotTag.innerHTML = `${timeslot} <button class="timeslot-remove-btn" onclick="removeTimeslot('${timeslot}')">&times;</button>`;
            timeslotContainer.appendChild(timeslotTag);
        });
    }

    function clearTimeslots() {
        selectedTimeslots.length = 0;
        updateTimeslotDisplay();
    }

    function saveTimeslots() {
        alert("Timeslots saved: " + selectedTimeslots.join(", "));
    }
</script>

<?php require APPROOT . '/views/Components/footer.php'; ?>
