let currentWeekIndex = 0;
const maxSlots = 6;
const maxSlotsPerWeek = 3;

// Populate initial week and slots
function initializeUniqueTimeslots() {
    updateUniqueWeek();
    populateUniqueSlots();
}

// Update week range title
function updateUniqueWeek() {
    const weekStart = allDates[currentWeekIndex * 7];
    const weekEnd = allDates[Math.min((currentWeekIndex + 1) * 7 - 1, allDates.length - 1)];
    document.getElementById("unique-week-range-title").textContent = `${weekStart} - ${weekEnd}`;
}

// Populate slots for the current week
function populateUniqueSlots() {
    const optionsContainer = document.getElementById("unique-options");
    optionsContainer.innerHTML = ""; // Clear previous slots

    const weekStartIndex = currentWeekIndex * 7;
    for (let i = weekStartIndex; i < weekStartIndex + 7 && i < allDates.length; i++) {
        const date = allDates[i];
        timeSlotsPerDay.forEach((time) => {
            const slotElement = document.createElement("button");
            slotElement.className = "unique-slot-btn";
            slotElement.textContent = `${date} ${time}`;
            slotElement.onclick = () => toggleUniqueSlot(date, time);

            // Check if slot is already selected
            if (selectedTimeslots.some((s) => s[0] === date && s[1] === time)) {
                slotElement.classList.add("selected");
            }
            optionsContainer.appendChild(slotElement);
        });
    }
}

// Toggle slot selection
// Toggle slot selection
function toggleUniqueSlot(date, time) {
    // Determine the week index of the selected date
    const slotWeekIndex = Math.floor(allDates.findIndex((d) => d === date) / 7);

    // Count the number of selected slots in the same week
    const selectedInWeek = selectedTimeslots.filter((s) => {
        const weekIndex = Math.floor(allDates.findIndex((d) => d === s[0]) / 7);
        return weekIndex === slotWeekIndex;
    }).length;

    // Check if the slot is already selected
    const slotIndex = selectedTimeslots.findIndex((s) => s[0] === date && s[1] === time);

    if (slotIndex !== -1) {
        // If the slot is already selected, remove it
        selectedTimeslots.splice(slotIndex, 1);
    } else if (selectedTimeslots.length < maxSlots && selectedInWeek < maxSlotsPerWeek) {
        // Add slot if it doesn't exceed overall or per-week limits
        selectedTimeslots.push([date, time]);
    } else if (selectedInWeek >= maxSlotsPerWeek) {
        alert(`You can only select up to ${maxSlotsPerWeek} slots per week.`);
    } else {
        alert(`You can only select up to ${maxSlots} slots in total.`);
    }

    populateUniqueSlots();
    displayUniqueSelectedSlots();
}


// Display selected slots
function displayUniqueSelectedSlots() {
    const selectedContainer = document.getElementById("unique-selected-timeslots");
    selectedContainer.innerHTML = "";

    if (selectedTimeslots.length === 0) {
        selectedContainer.innerHTML = `<p id="unique-no-slots-msg">No timeslots selected.</p>`;
    } else {
        selectedTimeslots.forEach(([date, time]) => {
            const tagElement = document.createElement("span");
            tagElement.className = "unique-timeslot-tag";
            tagElement.textContent = `${date} ${time}`;

            const removeBtn = document.createElement("button");
            removeBtn.className = "unique-remove-btn";
            removeBtn.innerHTML = "&times;";
            removeBtn.onclick = () => removeUniqueTimeslot(date, time);

            tagElement.appendChild(removeBtn);
            selectedContainer.appendChild(tagElement);
        });
    }
}

// Remove slot
function removeUniqueTimeslot(date, time) {
    const slotIndex = selectedTimeslots.findIndex((s) => s[0] === date && s[1] === time);
    if (slotIndex !== -1) {
        selectedTimeslots.splice(slotIndex, 1);
        populateUniqueSlots();
        displayUniqueSelectedSlots();
    }
}

// Clear all slots
function clearUniqueTimeslots() {
    selectedTimeslots.length = 0;
    displayUniqueSelectedSlots();
    populateUniqueSlots();
}

// Save slots (stub for back-end integration)
function saveUniqueTimeslots() {
    alert("Slots saved: " + JSON.stringify(selectedTimeslots));
}

// Change week
function changeUniqueWeek(offset) {
    currentWeekIndex += offset;
    document.getElementById("unique-prev-week").disabled = currentWeekIndex === 0;
    document.getElementById("unique-next-week").disabled = currentWeekIndex >= Math.floor(allDates.length / 7);
    updateUniqueWeek();
    populateUniqueSlots();
}

// Initialize on load
initializeUniqueTimeslots();