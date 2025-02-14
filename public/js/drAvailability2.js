let currentWeekIndex = 0;
const maxSlots = 6;
const maxSlotsPerWeek = 3;
const today = formatDate(new Date());

document.addEventListener("DOMContentLoaded", function () {
    displayUniqueSelectedSlots();
    if (successMessage.trim() !== "") {
        showToast(successMessage);
    }
});

function showToast(message) {
    var toast = document.getElementById("toast");
    var toastText = document.getElementById("toast-text");
    toastText.textContent = message;
    toast.classList.add("show");

    setTimeout(function () {
        toast.classList.remove("show");
    }, 3000); // Hide after 3 seconds
}


// Populate initial week and slots
function initializeUniqueTimeslots() {
    setCurrentWeekIndex();
    updateUniqueWeek();
    populateUniqueSlots();
}

// Set current week index
function setCurrentWeekIndex() {
    // Find the closest week to today
    for (let i = 0; i < allDates.length; i++) {
        if (allDates[i] === today) {
            currentWeekIndex = Math.floor(i / 7); // Set the current week index based on the found date
            break;
        }
    }
}

// Format date to "dd/mm/yyyy"
function formatDate(date) {
    const day = String(date.getDate()).padStart(2, "0");
    const month = String(date.getMonth() + 1).padStart(2, "0"); // Months are 0-indexed
    const year = date.getFullYear();
    return `${day}/${month}/${year}`;
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
    const today = new Date(); // Get today's date
    today.setHours(0, 0, 0, 0); // Normalize time for comparison

    // Ensure occupiedTimeslots is an array (handle null/undefined cases)
    const occupiedSlots = Array.isArray(occupiedTimeslots) ? occupiedTimeslots : [];

    for (let i = weekStartIndex; i < weekStartIndex + 7 && i < allDates.length; i++) {
        const dateStr = allDates[i]; // e.g., "05/02/2025"
        const dateParts = dateStr.split('/'); // Assuming format is "dd/mm/yyyy"
        const dateObj = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]); // Convert to Date object

        timeSlotsPerDay.forEach((time) => {
            const slotElement = document.createElement("button");
            slotElement.className = "unique-slot-btn";

            // Check if the slot is occupied or in the past
            const isDisabled = occupiedSlots.some(slot => slot.date === dateStr && slot.time === time) || dateObj <= today;
            if (isDisabled) {
                slotElement.classList.add("disabled");
            }

            slotElement.textContent = `${dateStr} ${time}`;
            slotElement.onclick = () => toggleUniqueSlot(dateStr, time);

            // Check if slot is already selected
            if (selectedTimeslots.some((s) => s[0] === dateStr && s[1] === time)) {
                slotElement.classList.add("selected");
            }

            optionsContainer.appendChild(slotElement);
        });
    }
}



// Toggle slot selection
function toggleUniqueSlot(date, time) {
    const slotElement = [...document.querySelectorAll(".unique-slot-btn")].find(
        btn => btn.textContent.includes(date) && btn.textContent.includes(time)
    );

    // Prevent clicking on disabled slots
    if (slotElement.classList.contains("disabled")) {
        return;
    }

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

            if (date > today) {
                const removeBtn = document.createElement("button");
                removeBtn.className = "unique-remove-btn";
                removeBtn.innerHTML = "&times;";
                removeBtn.onclick = () => removeUniqueTimeslot(date, time);

                tagElement.appendChild(removeBtn);
            }

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

// Clear only future slots
function clearUniqueTimeslots() {
    selectedTimeslots = selectedTimeslots.filter(([date, _]) => {

        return date <= today; // Keep only past or today's slots
    });

    displayUniqueSelectedSlots();
}

// Save slots (stub for back-end integration)
function saveUniqueTimeslots() {
    // Set the value of the hidden input field to send to the backend
    const hiddenInput = document.getElementById("selectedTimeslotsInput");
    hiddenInput.value = JSON.stringify(selectedTimeslots);
    document.getElementById("unique-timeslot-form").submit();
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