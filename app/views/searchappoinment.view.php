<?php require APPROOT.'/views/Components/header.php' ?>
<?php require APPROOT.'/views/Components/Navbar.php' ?>
<div class="container">
    <div class="topic">
        <img src="<?php echo URLROOT; ?>/assets/images/stethoscope.jpeg" class="stethoscope">
        <h1 class="title">Make an Appoinment</h1>
    </div>
    <div>
        <form class="section" method="$_POST">
            <span class="line1">Doctor</span>
            <input class="input" placeholder="Select Doctor"/>
            <span class="line1">Specialization</span>
            <input class="input" placeholder="Select Specialization"/>
            <span class="line1">Date</span>
            <input class="input" type="date"  placeholder="Select Date"/>
            <input class="btn" type="submit" value="Search"/>
        </form>  
    </div>
    <div class="doctors">
        <?php require APPROOT.'/views/Components/doctorcard.php' ?>
        <?php require APPROOT.'/views/Components/doctorcard.php' ?>
        <?php require APPROOT.'/views/Components/doctorcard.php' ?>
    </div>
   

    

</div>
<?php require APPROOT.'/views/Components/footer.php' ?>