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
        document.getElementById('ph-usage-prevMonth').addEventListener('click', () => this.previousMonth());
        document.getElementById('ph-usage-nextMonth').addEventListener('click', () => this.nextMonth());
        this.generateCalendar();
    }

    isToday(day) {
        const today = new Date();
        return day === today.getDate() && 
               this.currentMonth === today.getMonth() && 
               this.currentYear === today.getFullYear();
    }

    generateCalendar() {
        const firstDay = new Date(this.currentYear, this.currentMonth, 1);
        const lastDay = new Date(this.currentYear, this.currentMonth + 1, 0);
        const startingDay = firstDay.getDay();
        const totalDays = lastDay.getDate();

        document.getElementById('ph-usage-currentMonth').textContent = 
            `${this.monthNames[this.currentMonth]} ${this.currentYear}`;

        let calendarHTML = '';

        // Empty cells for days before the 1st
        for (let i = 0; i < startingDay; i++) {
            calendarHTML += '<div class="ph-usage-empty"></div>';
        }

        // Generate days of the month
        for (let day = 1; day <= totalDays; day++) {
            const dateString = `${this.currentYear}-${(this.currentMonth + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
            const isToday = this.isToday(day);

            calendarHTML += `
                <div class="ph-usage-calendar-date${isToday ? ' ph-usage-today' : ''}" 
                     data-date="${dateString}">
                    ${day}
                </div>`;
        }
        // Add generated HTML to the calendar container
        document.getElementById('ph-usage-calendarDates').innerHTML = calendarHTML;

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
        const dates = document.querySelectorAll('.ph-usage-calendar-date');
        dates.forEach(dateElement => {
            dateElement.style.cursor = 'pointer';
            dateElement.onclick = function() {
                const selectedDate = this.getAttribute('data-date');
                window.location.href = 'http://localhost/Health-Hub/public/phusagedate';
            };
        });
    }
    
    
}

// Initialize the calendar when the DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new Calendar();
});