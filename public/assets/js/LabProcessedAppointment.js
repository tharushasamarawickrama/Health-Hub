function deleteReport(labtestId) {
    if (confirm('Are you sure you want to delete this report?')) {
        fetch(`${URLROOT}/labprocessedappointment/deleteReport/${labtestId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.text())
        .then(data => {
            // Remove the report section from the page
            const reportSection = document.querySelector('.lab-proc-app-uploaded-reports');
            reportSection.innerHTML = '<h3>Uploaded reports</h3><p>No reports uploaded.</p>';
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}
