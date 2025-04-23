<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/reNavbar.php' ?>

<div class="upsection">

    <div class="selectdoctor">
    <div class="frame">
    <div class="card">
        <img src="<?php echo URLROOT; ?>/<?php echo $data['photo_path'] ?>" class="doctorpic">
    </div>

    <span class="doctorname">Dr.<?php echo $data['firstName'] . " " . $data['lastName'] ?></span>
    <span class="gender"><?php echo $data['gender'] ?></span>
    <span class="specialization"><?php echo $data['specialization'] ?></span>


    <div class="pt-button-div">
        <a href="<?php echo URLROOT; ?>channel?id=<?php echo $data['doctor_id'] ?>">
            <button class="channelbutton" name="channelnowbtn">Channel Now</button>
        </a>
        

    </div>


</div>
    </div>

    <div class="slotcard">
        <span class="availabletext">Available Times</span>
        <?php if (!empty($data2)): ?>
            <?php foreach ($data2 as $schedule): ?>
                <?php if ($schedule['is_cancelled'] == 'false'): ?>
                    <div class="slotcard">
    <div class="timeslot">
        <span class="date"><?php echo $schedule['weekday'] ?> </span>
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
                    <a href="<?php echo URLROOT; ?>resetappointment?id=<?php echo $schedule['doctor_id'] ?>&sch_id=<?php echo $schedule['schedule_id'] ?>">
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
</div>                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="pt-noresults-div">
                <span class="pt-noresults">No available Slots</span>
            </div>
        <?php endif; ?>
        <div>
            <a href="<?php echo URLROOT; ?>redashboard">
                <button class="payment-btn2">Back</button>
            </a>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/Components/footer.php' ?>
<script src="<?php echo URLROOT;?>/assets/js/rechannel.js"></script>
