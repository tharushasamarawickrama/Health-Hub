<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>

<div class="ptc-div1">
    
    <div class="ptc-div2">
        <h1 class="ptc-div2-h1">Channel Details</h1>
        <form method="POST">

            <span class="ptc-div2-span">Patient's Name:<span class="ptc-div2-span2"><?php echo $_SESSION['appointment']['p_firstName'] . " " . $_SESSION['appointment']['p_lastName'] ?></span></span>
            <span class="ptc-div2-span">NIC:<span class="ptc-div2-span2"><?php echo $_SESSION['appointment']['nic'] ?></span></span>
            <span class="ptc-div2-span">Phone Number:<span class="ptc-div2-span2"><?php echo $_SESSION['appointment']['phoneNumber'] ?></span></span>
            <span class="ptc-div2-span">Email:<span class="ptc-div2-span2"><?php echo $_SESSION['appointment']['email'] ?></span></span>
            <span class="ptc-div2-span">Doctor's Name:<span class="ptc-div2-span2">Dr. <?php echo $data['firstName'] . " " . $data['lastName']; ?></span></span>
            <span class="ptc-div2-span">Specialization:<span class="ptc-div2-span2"><?php echo $data['specialization']; ?></span></span>
            <span class="ptc-div2-span">SLMC NO:<span class="ptc-div2-span2"><?php echo $data['slmcNo']; ?></span></span>
            <span class="ptc-div2-span">Session Date:<span class="ptc-div2-span2"><?php echo $data['weekday']; ?></span></span>
            <span class="ptc-div2-span">Session Time:<span class="ptc-div2-span2"><?php echo $data['start_time']; ?></span></span>
            <span class="ptc-div2-span">appointment No:<span class="ptc-div2-span2"><?php echo $_SESSION['appointment']['appointment_No']; ?></span></span>




            <div class="ptc-div2-button-div">
                
                    <button type="button" class="ptc-div2-button" onclick="window.history.back()">Edit</button>
                
                <a href="<?php echo URLROOT; ?>/patientpaymentdetails">
                    <button type="submit" name="confirmbtn" class="ptc-div2-button">Confirm</button>
                </a>

            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/Components/footer.php' ?>