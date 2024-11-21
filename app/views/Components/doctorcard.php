<?php foreach($data as $doctor): ?>
<div class="frame">
    <div class="card">
        <img src="<?php echo URLROOT; ?>/assets/images/loginlogo.jpg" class="doctorpic">
    </div>
    
    <span class="doctorname">Dr.<?php echo $doctor['firstName']." ".$doctor['lastName'] ?></span>
    <span class="gender"><?php echo $doctor['gender'] ?></span>
    <span class="specialization">Specialization</span>
    <button class="channelbutton">Channel Now</button>
    <button class="viewbutton">View Profile</button>

</div>
<?php endforeach ?>