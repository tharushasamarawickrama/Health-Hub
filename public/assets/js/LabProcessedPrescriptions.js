class Calendar {
    constructor() {
        this.currentDate = new Date();
        this.currentMonth = this.currentDate.getMonth();
        this.currentYear = this.currentDate.getFullYear();
        this.monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];
        
        this.init();
    }

    init() {
        document.getElementById('lab-proc-prevMonth').addEventListener('click', () => this.previousMonth());
        document.getElementById('lab-proc-nextMonth').addEventListener('click', () => this.nextMonth());
        this.generateCalendar();

        const todayDateString = this.getTodayDateString();
        fetchAppointments(todayDateString);
    }

    isToday(day) {
        const today = new Date();
        return day === today.getDate() && 
               this.currentMonth === today.getMonth() && 
               this.currentYear === today.getFullYear();
    }
    getTodayDateString() {
        // Helper function to get today's date in YYYY-MM-DD format
        const today = this.currentDate;
        return `${today.getFullYear()}-${(today.getMonth() + 1).toString().padStart(2, '0')}-${today.getDate().toString().padStart(2, '0')}`;
    }

    generateCalendar() {
        const firstDay = new Date(this.currentYear, this.currentMonth, 1);
        const lastDay = new Date(this.currentYear, this.currentMonth + 1, 0);
        const startingDay = firstDay.getDay();
        const totalDays = lastDay.getDate();

        document.getElementById('lab-proc-currentMonth').textContent = 
            `${this.monthNames[this.currentMonth]} ${this.currentYear}`;

        let calendarHTML = '';

        // Empty cells for days before the 1st
        for (let i = 0; i < startingDay; i++) {
            calendarHTML += '<div class="lab-proc-empty"></div>';
        }

        // Generate days of the month
        for (let day = 1; day <= totalDays; day++) {
            const dateString = `${this.currentYear}-${(this.currentMonth + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
            const isToday = this.isToday(day);

            calendarHTML += `
                <div class="lab-proc-calendar-date${isToday ? ' lab-proc-today' : ''}" 
                     data-date="${dateString}">
                    ${day}
                </div>`;
        }

        // Add generated HTML to the calendar container
        document.getElementById('lab-proc-calendarDates').innerHTML = calendarHTML;

        // Attach event listeners to each date
        this.addDateListeners();
    }

    previousMonth() {
        this.currentMonth--;
        if (this.currentMonth < 0) {
            this.currentMonth = 11;
            this.currentYear--;
        }
        this.generateCalendar();
    }

    nextMonth() {
        this.currentMonth++;
        if (this.currentMonth > 11) {
            this.currentMonth = 0;
            this.currentYear++;
        }
        this.generateCalendar();
    }

    addDateListeners() {
        document.querySelectorAll('.lab-proc-calendar-date').forEach(date => {
            date.addEventListener('click', (e) => {
                // Remove previous selection
                document.querySelectorAll('.lab-proc-calendar-date').forEach(d => d.classList.remove('lab-proc-selected'));
                // Add selected class to clicked date
                e.target.classList.add('lab-proc-selected');
                // Fetch appointments for the selected date
                const selectedDate = e.target.dataset.date;
                fetchAppointments(selectedDate);
            });
        });
    }
}

// Initialize the calendar when the DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const calendar = new Calendar();
    
    // Fetch appointments for the current date on page load
    const today = new Date();
    const formattedDate = `${today.getFullYear()}-${(today.getMonth() + 1).toString().padStart(2, '0')}-${today.getDate().toString().padStart(2, '0')}`;
    fetchAppointments(formattedDate);
    
    // Mark today as selected
    setTimeout(() => {
        const todayElement = document.querySelector('.lab-proc-today');
        if (todayElement) {
            todayElement.classList.add('lab-proc-selected');
        }
    }, 100);
});

function fetchAppointments(date) {
    fetch(`${URLROOT}/LabProcessedPrescriptions/getAppointmentsByDate?date=${date}`)
        .then(response => response.json())
        .then(data => {
            const appointmentsContainer = document.getElementById('appointments-container');
            appointmentsContainer.innerHTML = '';
            if (data.length > 0) {
                data.forEach(appointment => {
                    const appointmentCard = `
                        <a href="${URLROOT}/labprocessedappointment?appointment_id=${appointment.appointment_id}" class="lab-proc-result-item">
                            <div class="lab-proc-appointment-card">
                                <div class="lab-proc-appointment-id">Appointment ID: ${appointment.appointment_id}</div>
                                <div>NIC: ${appointment.nic}</div>
                            </div>
                        </a>
                    `;
                    appointmentsContainer.innerHTML += appointmentCard;
                });
            } else {
                appointmentsContainer.innerHTML = '<div class="no-appointments">No completed appointments found for this date</div>';
            }
        })
        .catch(error => console.error('Error fetching appointments:', error));
}



