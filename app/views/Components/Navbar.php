<div class="Navbar">
    <a href="#">
        <img src="<?php echo URLROOT; ?>/assets/images/logohealth.png" class="logo">
    </a>

    <a href="<?php echo URLROOT; ?>home" class="navitems">Home</a>
    <a href="<?php if (isset($_SESSION['user'])): ?> <?php echo URLROOT; ?>searchappoinment <?php else: ?> <?php echo URLROOT; ?>patientregister <?php endif; ?>" class="navitems">Appointment</a>
    <a href="#" class="navitems">Inbox</a>

    <?php if (isset($_SESSION['user'])): ?>
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
                <a href="#">Profile</a>
                <a href="?action=logout">Logout</a>
            </div>
        </div>
    <?php else: ?>
        <!-- Show "Login" link if no user is logged in -->
        <a href="<?php echo URLROOT; ?>/Prevlog" class="login">Login</a>
    <?php endif; ?>
</div>