document.addEventListener('DOMContentLoaded', () => {
    const selectedContainer = document.getElementById('unique-selected-timeslots');
    const allSlotButtons = document.querySelectorAll('.unique-slot-btn');
    const selectedInput = document.getElementById('selectedTimeslotsInput');
    if (successMessage.trim() !== "") {
        showToast(successMessage);
    }

    // Convert dataset to slot string (used for matching and comparing)
    const slotToString = (slot) => `${slot[0]} - ${slot[1]}`;

    // Parse slot from stringified data-value
    const parseSlot = (el) => JSON.parse(el.dataset.value);

    // Check if slot is already selected
    const isSlotSelected = (slotStr) => {
        return Array.from(selectedContainer.querySelectorAll('.unique-timeslot-tag')).some(child => {
            const childSlot = JSON.parse(child.dataset.value);
            return slotToString(childSlot) === slotStr;
        });
    };

    // Initialize selected state from already rendered slots
    const initSelectedSlots = () => {
        const selectedSlotStrings = Array.from(selectedContainer.querySelectorAll('.unique-timeslot-tag'))
            .map(el => slotToString(JSON.parse(el.dataset.value)));

        allSlotButtons.forEach(btn => {
            const slot = parseSlot(btn);
            const str = slotToString(slot);
            if (selectedSlotStrings.includes(str)) {
                btn.classList.add('selected');
            }
        });

        updateHiddenInput();
    };

    // Update hidden input field
    const updateHiddenInput = () => {
        const selected = Array.from(selectedContainer.querySelectorAll('.unique-timeslot-tag')).map(el =>
            JSON.parse(el.dataset.value)
        );
        selectedInput.value = JSON.stringify(selected);
    };

    // Remove slot
    window.removeSlot = (icon) => {
        const tag = icon.parentElement;
        const slotStr = slotToString(JSON.parse(tag.dataset.value));
        tag.remove();

        // Unhighlight from the right section
        allSlotButtons.forEach(btn => {
            const btnSlotStr = slotToString(parseSlot(btn));
            if (btnSlotStr === slotStr) {
                btn.classList.remove('selected');
            }
        });

        updateHiddenInput();
    };

    // Clear all slots
    window.clearUniqueTimeslots = () => {
        selectedContainer.innerHTML = '<p>No timeslots selected.</p>';
        allSlotButtons.forEach(btn => btn.classList.remove('selected'));
        updateHiddenInput();
    };

    function showToast(message) {
        const toast = document.getElementById("toast");
        document.getElementById("toast-text").textContent = message;
        toast.classList.add("show");
        setTimeout(() => toast.classList.remove("show"), 3000);
    }

    function saveUniqueTimeslots() {
        document.getElementById("selectedTimeslotsInput").value = JSON.stringify(selectedTimeslots);
        document.getElementById("unique-timeslot-form").submit();
    }

    // Add or remove slot
    window.toggleSlot = (btn) => {
        const slot = parseSlot(btn);
        const slotStr = slotToString(slot);

        const alreadySelected = isSlotSelected(slotStr);
        let selectedTags = Array.from(selectedContainer.querySelectorAll('.unique-timeslot-tag'));

        if (alreadySelected) {
            alert("This timeslot is already selected.");
            return;
        } else {
            if (selectedTags.length >= 3) {
                alert("You can only select up to 3 timeslots.");
                return;
            }

            // Remove "No timeslots selected." message
            const noSlotsMessage = selectedContainer.querySelector('p');
            if (noSlotsMessage) noSlotsMessage.remove();

            const newTag = document.createElement('div');
            newTag.className = 'unique-timeslot-tag';
            newTag.dataset.value = JSON.stringify(slot);
            newTag.innerHTML = `
                ${slotStr}
                <span class="delete-icon" onclick="removeSlot(this)">✖</span>
            `;
            selectedContainer.appendChild(newTag);
            btn.classList.add('selected');
        }

        updateHiddenInput();
    };

    initSelectedSlots();
});
