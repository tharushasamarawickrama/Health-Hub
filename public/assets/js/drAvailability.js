const selectedSlots = document.querySelector('.selected-slots');
const timeslotsContainer = document.querySelector('.timeslot-container');
const confirmBtn = document.querySelector('.confirm-btn');

// Dummy data for available slots
const availableSlots = [
    { date: '14/10/2024', time: '8AM-11AM', occupied: false },
    { date: '14/10/2024', time: '4PM-7PM', occupied: true },
    { date: '15/10/2024', time: '8AM-11AM', occupied: false },
    { date: '15/10/2024', time: '4PM-7PM', occupied: false },
    // ... more slots as needed
];

function createTimeslot(slot) {
    const timeslot = document.createElement('div');
    timeslot.classList.add('timeslot');
    timeslot.textContent = `${slot.date} ${slot.time}`;
    if (slot.occupied) {
        timeslot.classList.add('occupied');
    } else {
        timeslot.addEventListener('click', () => {
            const selectedSlot = document.createElement('div');
            selectedSlot.classList.add('selected-slot');
            selectedSlot.textContent = `${slot.date} ${slot.time}`;
            const deleteBtn = document.createElement('button');
            deleteBtn.classList.add('delete-btn');
            deleteBtn.textContent = 'X';
            deleteBtn.addEventListener('click', () => {
                selectedSlot.remove();
                slot.occupied = false;
                timeslot.classList.remove('occupied');
            });
            selectedSlot.appendChild(deleteBtn);
            selectedSlots.appendChild(selectedSlot);
            slot.occupied = true;
            timeslot.classList.add('occupied');
        });
    }
    return timeslot;
}

availableSlots.forEach(slot => {
    timeslotsContainer.appendChild(createTimeslot(slot));
});

confirmBtn.addEventListener('click', () => {
    // Handle confirmation logic here, e.g., send selected slots to server
    console.log('Selected slots:', selectedSlots.innerHTML);
});