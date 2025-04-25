<div class="Navbar">
    <a href="#">
        <img src="<?php echo URLROOT; ?>/assets/images/logohealth.png" class="logo">
    </a>

    <a href="<?php echo URLROOT; ?>home" class="navitems">Home</a>
    <a href=" <?php echo URLROOT; ?>searchappoinment?>" class="navitems">Appointment</a>
    <?php if (isset($_SESSION['user'])): ?>
        <a href="<?php echo URLROOT; ?>patienthistory" class="navitems">History</a>
    <?php endif; ?>

    <?php if (isset($_SESSION['user']) && $_SESSION['user']['photo_path'] !== '' 
    ): ?>
        <a href="#" class="logname dropdown-toggle">

            <img src="<?php echo URLROOT . '/' . htmlspecialchars($_SESSION['user']['photo_path']); ?>" class="loginlogo">
        </a>
    <?php else: ?>
        <img src="<?php echo URLROOT; ?>/assets/images/loginlogo.jpg" class="loginlogo">
    <?php endif; ?>
    <?php if (isset($_SESSION['user'])): ?>
        <!-- User dropdown -->
        <div class="dropdown">


            <p class="username"><?php echo htmlspecialchars($_SESSION['user']['firstName']); ?></p>

            <div class="dropdown-content">
                <a href="<?php echo URLROOT; ?>patientprofile">Profile</a>
                <a href="<?php echo URLROOT; ?>pendingappointment">Pending Appointment</a>
                <a href="?action=logout">Logout</a>
            </div>
        </div>
    <?php else: ?>
        <!-- Show "Login" link if no user is logged in -->
        <a href="<?php echo URLROOT; ?>/patientregister" class="login">Login</a>
    <?php endif; ?>
</div>