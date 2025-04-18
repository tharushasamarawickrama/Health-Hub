<div class="slotcard">
    <div class="timeslot">
        <span class="date"><?php echo $schedule['date'] ?> </span>
        <div class="inrectangle">
            <div class="slots">
                <?php
                $starttimeparts = explode(":", $schedule['start_time']);
                $endtimeparts = explode(":", $schedule['end_time']);
                ?>
                <?php if ($schedule['filled_slots'] < $schedule['total_slots']): ?>
                    <span><?php echo $schedule['total_slots'] - $schedule['filled_slots'] ?> slots available</span>
                <?php else: ?>
                    <span>No slots available</span>
                <?php endif; ?>
                <span class="time"><?php echo $starttimeparts[0] ?> PM - <?php echo $endtimeparts[0] ?> PM</span>
            </div>
            <div>
                <?php if ($schedule['filled_slots'] < $schedule['total_slots']): ?>
                    <a href="<?php echo URLROOT; ?>setappoinment?id=<?php echo $schedule['doctor_id'] ?>&sch_id=<?php echo $schedule['schedule_id'] ?>">
                        <button class="schedulebutton">Schedule Appointment</button>
                    </a>
                <?php else: ?>
                    <button class="schedulebutton no-slot-button" data-schedule-id="<?php echo $schedule['schedule_id']; ?>">Schedule Appointment</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Popup Modal -->
<div id="no-slot-modal-<?php echo $schedule['schedule_id']; ?>" class="modal no-slot-modal">
    <div class="modal-content">
        <p>No slot available.</p>
        <button class="close-modal" data-schedule-id="<?php echo $schedule['schedule_id']; ?>">Back</button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const noSlotButtons = document.querySelectorAll(".no-slot-button");
        const modals = document.querySelectorAll(".no-slot-modal");
        const closeModalButtons = document.querySelectorAll(".close-modal");

        noSlotButtons.forEach(button => {
            button.addEventListener("click", function() {
                const scheduleId = this.getAttribute("data-schedule-id");
                const modal = document.getElementById(`no-slot-modal-${scheduleId}`);
                modal.style.display = "block";
            });
        });

        closeModalButtons.forEach(button => {
            button.addEventListener("click", function() {
                const scheduleId = this.getAttribute("data-schedule-id");
                const modal = document.getElementById(`no-slot-modal-${scheduleId}`);
                modal.style.display = "none";
            });
        });

        window.addEventListener("click", function(event) {
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        });
    });
</script>