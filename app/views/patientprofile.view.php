<?php require APPROOT . '/views/Components/header.php' ?>



<div class="profiletopicdiv">
    <h1 class="profiletopic">Patient Profile</h1>
</div>
<div class="line-image-div">
    <div>
        <div>

            <img src="<?php echo htmlspecialchars($_SESSION['user']['ProfilePic']); ?>" class="profileimg">
        </div>
        <h1 class="profilename"><?php echo htmlspecialchars($_SESSION['user']['FirstName']); ?></h1>
    </div>
    <div class="line-div"></div>
    <?php if (isset($_SESSION['user'])): ?>
        <div>
            <div class="patientinfo-first-div">
                <span class="patientdetails">Name <span class="infovalue">: <?php echo htmlspecialchars($_SESSION['user']['FirstName']); ?></span></span><br>
            </div>
            <div class="patientinfo-div">
                <span class="patientdetails">Email <span class="infovalue">: <?php echo htmlspecialchars($_SESSION['user']['Email']); ?></span></span><br>
            </div>
            <div class="patientinfo-div">
                <span class="patientdetails">Phone Number <span class="infovalue">: <?php echo htmlspecialchars($_SESSION['user']['PhoneNumber']); ?></span></span><br>
            </div>
            <div class="patientinfo-div">
                <span class="patientdetails">NIC <span class="infovalue">: <?php echo htmlspecialchars($_SESSION['user']['NIC']); ?></span></span><br>
            </div>
            <div class="patientinfo-div">
                <span class="patientdetails">Gender <span class="infovalue">: <?php echo htmlspecialchars($_SESSION['user']['Gender']); ?></span></span><br>
            </div>
            <div class="patientinfo-div">
                <span class="patientdetails">Age <span class="infovalue">: <?php echo htmlspecialchars($_SESSION['user']['Age']); ?></span></span><br>
            </div>
            <div class="patientinfo-div">
                <span class="patientdetails">Address <span class="infovalue">: <?php echo htmlspecialchars($_SESSION['user']['Address']); ?></span></span><br>
            </div>
        </div>
    <?php endif; ?>
    <div>
        <div class="profilepagelogo">
            <img src="<?php echo URLROOT; ?>/assets/images/healthhublogo.jpeg">
        </div>

        <div class="dlte-update-btn-div">
            <div>
                <a href="<?php echo URLROOT; ?>editpatientprofile"><button class="profilebtn">Edit Profile</button></a>
            </div>
            <div>
                <form action="" method="post">
                    <button class="profilebtn" name="delete" type="submit">Delete Profile</button>
                </form>
            </div>

        </div>
    </div>

</div>




<?php require APPROOT . '/views/Components/footer.php' ?>