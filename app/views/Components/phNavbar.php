<?php
// Start the session to enable session management
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Logout functionality
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Unset all of the session variables
    $_SESSION = array();
    unset($_SESSION['user']);

    // Destroy the session
    session_destroy();

    // Redirect to the login page or homepage
    header("Location: " . URLROOT . "/Prevlog");
    exit; // Ensure no further code is executed after redirect
}
?>
<div class="phNavbar">
            <img src="<?php echo URLROOT; ?>/assets/images/logohealth.png" alt="Health Hub Logo" class="phlogo">
        
            <a href="<?php echo URLROOT; ?>/phdashboard" class="phNavitems">Dashboard</a> 
            

            <?php if (isset($_SESSION['user'])): ?>
                <a href="#">
                <img src="<?php echo URLROOT .'/'. htmlspecialchars($_SESSION['user']['photo_path'])?>" alt="User Icon" class="phloginlogo">
            <?php else: ?>
                <a><img src="<?php echo URLROOT; ?>/assets/images/loginlogo.jpg" alt="User Icon" class="phloginlogo">
            <?php endif; ?>
            <!-- <a href="#" class="phlogin">Pharmacist</a> -->
            <?php if (isset($_SESSION['user'])): ?>
                <!-- User dropdown -->
                <div class="dropdown">
                    <p class="username"><?php echo htmlspecialchars($_SESSION['user']['firstName']); ?></p>
                    <div class="dropdown-content">
                        <a href="<?php echo URLROOT; ?>doctorprofile">Profile</a>
                        <a href="?action=logout">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <!-- Show "Login" link if no user is logged in -->
                <a href="<?php echo URLROOT; ?>/patientregister" class="login">Login</a>
            <?php endif; ?>
        </div>
</div>