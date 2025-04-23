function confirmDelete(labtest_id, appointment_id) {
    console.log("Delete called with:", labtest_id, appointment_id);

    if (confirm("Are you sure you want to delete this report?")) {
        fetch(`${URLROOT}/labpendingappointment/deleteReport`, { // Fixed URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ labtest_id, appointment_id })
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                location.reload();
            }
        })
        .catch(err => {
            console.error("Error:", err);
            alert("An error occurred while deleting the report.");
        });
    }
}