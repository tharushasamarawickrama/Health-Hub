// Populate the display on page load
document.addEventListener("DOMContentLoaded", () => {
    updateTimeslotDisplay();
    highlightPreselectedSlots();
});

// Function to highlight pre-selected timeslotsfunction highlightPreselectedSlots() {
function highlightPreselectedSlots() {
    const buttons = document.querySelectorAll(".timeslot-button");
    buttons.forEach(button => {
        // Normalize the button's text by replacing <br> with space and trimming
        const slotText = button.innerHTML.replace(/<br\s*\/?>/gi, " ").replace(/\n/g, "").trim();
        // Compare with selectedTimeslots (which uses space in place of newline)
        if (selectedTimeslots.includes(slotText)) {
            button.classList.add("selected");
        }
    });
}

// Event delegation for dynamically added remove buttons
document.getElementById("selected-timeslots").addEventListener("click", function(e) {
    if (e.target && e.target.classList.contains("timeslot-remove-btn")) {
        const timeslot = e.target.getAttribute("data-timeslot");
        removeTimeslot(timeslot);
    }
});

function addTimeslot(slotName, buttonElement) {
    if (!selectedTimeslots.includes(slotName)) {
        selectedTimeslots.push(slotName); // Add to array
        
        updateTimeslotDisplay(); // Refresh UI
        buttonElement.classList.add("selected"); // Add the visual indicator
    } else {
        removeTimeslot(slotName); // Remove if already selected
        buttonElement.classList.remove("selected"); // Remove visual indicator
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