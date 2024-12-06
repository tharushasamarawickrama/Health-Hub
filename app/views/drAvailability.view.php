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
                    onclick="addTimeslot('<?php echo addslashes(str_replace(["\n", "\r"], " ", htmlspecialchars($timeslot))); ?>')" 
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

    // Populate the display on page load
    document.addEventListener("DOMContentLoaded", () => {
        updateTimeslotDisplay();
    });

    // Event delegation for dynamically added remove buttons
    document.getElementById("selected-timeslots").addEventListener("click", function(e) {
        if (e.target && e.target.classList.contains("timeslot-remove-btn")) {
            const timeslot = e.target.getAttribute("data-timeslot");
            removeTimeslot(timeslot);
        }
    });

    // Add timeslot to the selected list
    function addTimeslot(slotName) {
        if (!selectedTimeslots.includes(slotName)) {
            selectedTimeslots.push(slotName); // Add to array
            updateTimeslotDisplay(); // Refresh UI
        } else {
            alert(slotName + " is already selected.");
        }
    }

    // Update the selected timeslot display
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
            timeslotTag.innerHTML = `${timeslot} <button class="timeslot-remove-btn" data-timeslot="${timeslot}">&times;</button>`;
            timeslotContainer.appendChild(timeslotTag);
        });
    }

    // Remove selected timeslot from the array and update display
    function removeTimeslot(slotName) {
        const index = selectedTimeslots.indexOf(slotName);
        if (index > -1) {
            selectedTimeslots.splice(index, 1);
            updateTimeslotDisplay();
        }
    }

    // Clear all selected timeslots
    function clearTimeslots() {
        selectedTimeslots.length = 0;
        updateTimeslotDisplay();
    }

// Prepare selected timeslots before submitting the form
function prepareSave() {
    // Extract the day names from each selected timeslot string
    const dayNames = selectedTimeslots.map(timeslot => {
        // Match the day part (Mon, Tue, etc.) in the timeslot string
        const match = timeslot.match(/\b(Mon|Tue|Wed|Thu|Fri|Sat|Sun)\b/);
        return match ? match[0] : null;  // Return the day name if found
    }).filter(Boolean);  // Filter out any null values (in case the match fails)

    console.log("Selected Days:", dayNames);

    // Set the value of the hidden input field to send to the backend
    const selectedTimeslotsInput = document.getElementById("selectedTimeslotsInput");
    selectedTimeslotsInput.value = dayNames.join(",");  // Join the day names into a comma-separated string

    // Log the details to the console for debugging
    console.log("Input Field Value (Day Names):", selectedTimeslotsInput.value);
}
</script>

<?php require APPROOT . '/views/Components/footer.php'; ?>
