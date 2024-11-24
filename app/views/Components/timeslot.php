<div class="slotcard">

    <div class="timeslot">
        <span class="date"><?php echo $schedule['date'] ?> </span>
        <div class="inrectangle">
            <div class="slots">
                <?php
                $starttimeparts = explode(":", $schedule['start_time']);
                $endtimeparts = explode(":", $schedule['end_time']);
                ?>
                <span><?php echo $schedule['filled_slots'] ?> of <?php echo $schedule['total_slots'] ?> slots available</span>
                <span class="time"><?php echo $starttimeparts[0] ?> PM - <?php echo $endtimeparts[0] ?>PM</span>
            </div>
            <div>
                <a href="<?php echo URLROOT; ?>setappoinment?id=<?php echo $schedule['doctor_id'] ?>">
                    <button class="schedulebutton">Schedule Appoinment</button>
                </a>

            </div>

        </div>
    </div>
</div>