document.getElementById('lab-pres-searchInput').addEventListener('keypress', function (event) {
    if (event.key === 'Enter') {
        searchLabAppointment();
    }
});

function searchLabAppointment() {
    const appointmentId = document.getElementById('lab-pres-searchInput').value.trim();
    const resultContainer = document.getElementById('lab-pres-resultContainer');

    if (!appointmentId) {
        alert('Please enter an appointment ID');
        return;
    }

    // Make the result container visible and clear previous results
    resultContainer.classList.remove('visible', 'hidden');
    resultContainer.classList.add('visible');
    resultContainer.innerHTML = '';

    fetch(`${URLROOT}/labprescriptions/search`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ appointment_id: appointmentId })
    })
        .then(response => response.json())
        .then(data => {
            console.log('Search response:', data); // Add this line
            if (data.appointments && data.appointments.length > 0) {
    
                data.appointments.forEach(appointment => {
                    const link = document.createElement('a');
                    link.href = `${URLROOT}/labprescriptionappointment?appointment_id=${appointment.appointment_id}`;                    link.className = 'lab-pres-result-item';
                    link.innerHTML = `
                        <div>Appointment ID: ${appointment.appointment_id}</div>
                        <div>NIC: ${appointment.nic}</div>
                    `;
                    resultContainer.appendChild(link);
                });
            } else {
                resultContainer.innerHTML = '<div class="no-appointments">No appointments found</div>';
            }
        })
        .catch(error => {
            console.error('Error fetching appointment data:', error);
            alert('Failed to fetch appointment data.');
        });
}
