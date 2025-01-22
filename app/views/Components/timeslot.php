<div class="slotcard">

    <div class="timeslot">
        <span class="date"><?php echo $schedule['date'] ?> </span>
        <div class="inrectangle">
            <div class="slots">
                <?php
                $starttimeparts = explode(":", $schedule['start_time']);
                $endtimeparts = explode(":", $schedule['end_time']);
                ?>
                <?php if($schedule['filled_slots']< $schedule['total_slots']): ?>
                <span><?php echo $schedule['total_slots'] - $schedule['filled_slots'] ?> slots available</span>
                <?php else: ?>
                <span>No slots available</span>
                <?php endif; ?>
                <span class="time"><?php echo $starttimeparts[0] ?> PM - <?php echo $endtimeparts[0] ?>PM</span>
            </div>
            <div>
                <?php if($schedule['filled_slots']< $schedule['total_slots']): ?>
                <a href="<?php echo URLROOT; ?>setappoinment?id=<?php echo $schedule['doctor_id'] ?>&sch_id=<?php echo $schedule['schedule_id'] ?>">
                    <button class="schedulebutton">Schedule Appoinment</button>
                </a>
                <?php else: ?>
                <button class="schedulebutton" id="no-slot-button">Schedule Appoinment</button>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<!-- Popup Modal -->
<div id="no-slot-modal" class="modal">
    <div class="modal-content">
        <p>No slot available.</p>
        <button id="close-modal">Back</button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const noSlotButton = document.getElementById("no-slot-button");
    const modal = document.getElementById("no-slot-modal");
    const closeModal = document.getElementById("close-modal");

    // Show modal when the "No Slot Available" button is clicked
    if (noSlotButton) {
        noSlotButton.addEventListener("click", function () {
            modal.style.display = "block";
        });
    }

    // Close modal when the "Back" button is clicked
    closeModal.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Close modal when clicking outside of the modal content
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});

</script>