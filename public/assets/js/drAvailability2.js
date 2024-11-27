let currentWeekIndex = 0;
const maxSlots = 10;

// Populate initial week and slots
function initializeUniqueTimeslots() {
    updateUniqueWeek();
    populateUniqueSlots();
}

// Update week range title
function updateUniqueWeek() {
    const weekStart = allDates[currentWeekIndex * 6];
    const weekEnd = allDates[Math.min((currentWeekIndex + 1) * 6 - 1, allDates.length - 1)];
    document.getElementById("unique-week-range-title").textContent = `${weekStart} - ${weekEnd}`;
}

// Populate slots for the current week
function populateUniqueSlots() {
    const optionsContainer = document.getElementById("unique-options");
    optionsContainer.innerHTML = ""; // Clear previous slots

    const weekStartIndex = currentWeekIndex * 6;
    for (let i = weekStartIndex; i < weekStartIndex + 6 && i < allDates.length; i++) {
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
function toggleUniqueSlot(date, time) {
    const slotIndex = selectedTimeslots.findIndex((s) => s[0] === date && s[1] === time);
    if (slotIndex !== -1) {
        selectedTimeslots.splice(slotIndex, 1);
    } else if (selectedTimeslots.length < maxSlots) {
        selectedTimeslots.push([date, time]);
    } else {
        alert(`You can only select up to ${maxSlots} slots.`);
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
    document.getElementById("unique-next-week").disabled = currentWeekIndex >= Math.floor(allDates.length / 6);
    updateUniqueWeek();
    populateUniqueSlots();
}

// Initialize on load
initializeUniqueTimeslots();
