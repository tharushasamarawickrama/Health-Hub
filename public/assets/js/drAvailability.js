document.addEventListener("DOMContentLoaded", function() {
    // Initialize the selected timeslots from PHP
    const selectedTimeslots = <?php echo json_encode($cleanedTimeslots); ?>;

    // Event delegation for dynamically added remove buttons
    document.getElementById("selected-timeslots").addEventListener("click", function(e) {
        if (e.target && e.target.classList.contains("timeslot-remove-btn")) {
            const timeslot = e.target.parentElement.textContent.trim().slice(0, -1); // Get the timeslot name
            removeTimeslot(timeslot);
        }
    });

    // Add event listener to all timeslot buttons
    document.querySelectorAll('.timeslot-button').forEach(button => {
        button.addEventListener("click", function() {
            const slotName = this.textContent.trim();
            if (!selectedTimeslots.includes(slotName)) {
                selectedTimeslots.push(slotName);
                updateTimeslotDisplay();
            } else {
                alert(slotName + " is already selected.");
            }
        });
    });

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
            timeslotTag.innerHTML = `${timeslot} <button class="timeslot-remove-btn">&times;</button>`;
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

    // Save the selected timeslots
    function saveTimeslots() {
        alert("Timeslots saved: " + selectedTimeslots.join(", "));
    }

    // Attach the clear and save button functions to respective buttons
    document.querySelector('.timeslot-button-clear').addEventListener('click', clearTimeslots);
    document.querySelector('.timeslot-button-save').addEventListener('click', saveTimeslots);
});
