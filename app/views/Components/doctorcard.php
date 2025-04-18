<div class="frame">
    <div class="card">
        <img src="<?php echo URLROOT; ?>/<?php echo $doctor['photo_path'] ?>" class="doctorpic">
    </div>

    <span class="doctorname">Dr.<?php echo $doctor['firstName'] . " " . $doctor['lastName'] ?></span>
    <span class="gender"><?php echo $doctor['gender'] ?></span>
    <span class="specialization"><?php echo $doctor['specialization'] ?></span>
    
    
    <div class="pt-button-div">
        <a href="<?php echo URLROOT; ?>channel?id=<?php echo $doctor['doctor_id'] ?>">
            <button class="channelbutton" name="channelnowbtn">Channel Now</button>
        </a>
        <a href="#">
            <button class="viewbutton">View Profile</button>
        </a>

    </div>


</div>