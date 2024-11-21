/*function searchAppointment() {
    const searchInput = document.getElementById("searchInput").value.trim();
    const resultContainer = document.getElementById("resultContainer");

    // Clear previous results
    resultContainer.innerHTML = "";

    // Hardcoded data
    const appointments = [
        { appointmentId: "4565", patientNIC: "200213288759" },
        { appointmentId: "1234", patientNIC: "300415678912" },
        { appointmentId: "7890", patientNIC: "400517345678" },
    ];

    // Filter results
    const filteredAppointments = appointments.filter(item =>
        item.appointmentId.includes(searchInput)
    );

    if (filteredAppointments.length === 0) {
        resultContainer.innerHTML = "<p>No results found</p>";
        return;
    }

    filteredAppointments.forEach(item => {
        const card = document.createElement("div");
        card.className = "result-card";
        card.innerHTML = `
            <p><strong>Appointment ID:</strong> ${item.appointmentId}</p>
            <p><strong>Patient NIC:</strong> ${item.patientNIC}</p>
        `;
        
        // Make card a clickable button
        card.onclick = () => alert(`Appointment ID: ${item.appointmentId}\nPatient NIC: ${item.patientNIC}`);

        resultContainer.appendChild(card);
    });
}
*/