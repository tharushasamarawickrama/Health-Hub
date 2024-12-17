//availability.view.php
<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

$fetchedTimeslots = ["2/12/2024", "4/12/2024"];
$allTimeslots = [
    "2/12/2024",
    "3/12/2024",
    "4/12/2024",
    "5/12/2024",
    "6/12/2024",
    "7/12/2024",
];
?>

<div class="dr-availability-container">
    <div class="dr-availability-header">
        <a href="<?php echo URLROOT; ?>drDashboard" class="availability-back-arrow">
            <img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back">
        </a>
        <h3>Selected Timeslots</h3>
        <h3 class="select-timeslots">Select Timeslots</h3>
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
                <button class="timeslot-action-clear" onclick="clearTimeslots()">Clear</button>
                <button class="timeslot-action-save" onclick="saveTimeslots()">Save</button>
            </div>
        </div>

        <div class="timeslot-options">
            <?php foreach ($allTimeslots as $timeslot): ?>
                <?php 
                    $dateParts = explode("/", $timeslot); // Split into day, month, year
                    $formattedDate = "{$dateParts[2]}-{$dateParts[1]}-{$dateParts[0]}"; // Rearrange to YYYY-MM-DD

                    $date = new DateTime($formattedDate); // Create DateTime object
                    $day = $date->format('l'); // Get the day name (e.g., Monday)
                ?>
                <button 
                    class="timeslot-button <?php echo in_array($timeslot, $fetchedTimeslots) ? 'disabled' : ''; ?>" 
                    onclick="<?php echo in_array($timeslot, $fetchedTimeslots) ? '' : "addTimeslot('$timeslot')"; ?>"
                    <?php echo in_array($timeslot, $fetchedTimeslots) ? 'disabled' : ''; ?>>
                    <?php echo htmlspecialchars($day); ?><br>
                    <?php echo htmlspecialchars($timeslot); ?><br>
                    <?php echo htmlspecialchars("8AM - 5PM"); ?>
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

            const timeslotButtons = document.querySelectorAll(".timeslot-button");
            timeslotButtons.forEach(button => {
                if (button.textContent.includes(slotName)) {
                    button.classList.add("selected");
                }
            });

            updateTimeslotDisplay();
        } else {
            alert(slotName + " is already selected.");
        }
    }


    function removeTimeslot(slotName) {
        const index = selectedTimeslots.indexOf(slotName);
        if (index > -1) {
            selectedTimeslots.splice(index, 1);

            const timeslotButtons = document.querySelectorAll(".timeslot-button");
            timeslotButtons.forEach(button => {
                if (button.textContent.includes(slotName)) {
                    button.classList.remove("selected");
                }
            });

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
