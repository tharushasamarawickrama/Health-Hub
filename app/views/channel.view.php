<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>
<div class="upsection">
    <div class="selectdoctor">
        <?php
        $doctor = $data;
        require APPROOT . '/views/Components/doctorcard.php' ?>
    </div>

    <div class="slotcard">
        <span class="availabletext">Available Times</span>
        <?php if (!empty($data2)): ?>
            <?php foreach ($data2 as $schedule): ?>
                <?php

                require APPROOT . '/views/Components/timeslot.php' ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="pt-noresults-div">
                <span class="pt-noresults">No available Slots</span>
            </div>

        <?php endif; ?>
        <!-- <?php
                $doctor = $data;
                require APPROOT . '/views/Components/timeslot.php' ?>
        <?php
        $doctor = $data;
        require APPROOT . '/views/Components/timeslot.php' ?> -->
    </div>



</div>




<?php require APPROOT . '/views/Components/footer.php' ?>