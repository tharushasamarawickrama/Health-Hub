document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('date-input');
    const todayBtn = document.getElementById('today-btn');

    // Set today's date when clicking the today button
    todayBtn.addEventListener('click', function() {
        dateInput.value = new Date().toISOString().split('T')[0];
    });
});
