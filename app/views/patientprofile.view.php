<?php require APPROOT . '/views/Components/header.php' ?>


<div class="patientprofilemain">
    <div class="Navbar">
        <a href="#">
            <img src="<?php echo URLROOT; ?>/assets/images/logohealth.png" class="logo">
        </a>

        <a href="<?php echo URLROOT; ?>home" class="navitems">Home</a>
        <a href="#" class="navitems">About</a>
        <a href="#" class="navitems">Contact</a>

        <?php if (isset($_SESSION['user'])): ?>
            <a href="#" class="logname dropdown-toggle">

                <img src="<?php echo URLROOT . '/' . htmlspecialchars($_SESSION['user']['ProfilePic']); ?>" class="loginlogo">
            </a>
        <?php else: ?>
            <img src="<?php echo URLROOT; ?>/assets/images/loginlogo.jpg" class="loginlogo">
        <?php endif; ?>
        <?php if (isset($_SESSION['user'])): ?>
            <!-- User dropdown -->
            <div class="dropdown">


                <p class="username"><?php echo htmlspecialchars($_SESSION['user']['FirstName']); ?></p>

                <div class="dropdown-content">
                    <a href="<?php echo URLROOT; ?>patientprofile">Profile</a>
                    <a href="?action=logout">Logout</a>
                </div>
            </div>
        <?php else: ?>
            <!-- Show "Login" link if no user is logged in -->
            <a href="<?php echo URLROOT; ?>/Prevlog" class="login">Login</a>
        <?php endif; ?>
    </div>

    <div class="profiletopicdiv">
        <h1 class="profiletopic">Patient Profile</h1>
    </div>
    <div class="line-image-div">
        <div>
            <div>

                <img src="<?php echo isset($_SESSION['user']['ProfilePic']) && !empty($_SESSION['user']['ProfilePic'])
                                ? htmlspecialchars($_SESSION['user']['ProfilePic'])
                                : URLROOT . '/assets/images/profile-men.png'; ?>"
                    class="profileimg">
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
                        <button class="profilebtn" name="delete" onclick="event.preventDefault(); openconfirmdeleteModal()">Delete Profile</button>
                    </form>
                </div>

            </div>
        </div>

    </div>

    <div id="deleteconfirmation-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Delete the Profile?</p>
            <form class="updatemodal-buttons" method="POST">
                <button class="updateyes-btn" name="deleteProfile" type="submit">Yes</button>
                <button class="updateno-btn" onclick="closeconfirmdeleteModal()">No</button>
            </form>
        </div>     
    </div>
</div>
<script>
    function openconfirmdeleteModal() {
        document.getElementById('deleteconfirmation-modal').style.display = 'block';
        modal.style.display = 'flex'; // Use flex for centering modal
    }

    function closeconfirmdeleteModal() {
        document.getElementById('deleteconfirmation-modal').style.display = 'none';
    }

    function confirmDelete(id) {
        window.location.href = '../../patientprofile?id=' + id;
        // successToast("Advertisement deleted successfully");
    }
</script>


<?php require APPROOT . '/views/Components/footer.php' ?>