
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
    header("Location: " . URLROOT . "/patientregister");
    exit; // Ensure no further code is executed after redirect
}
?><div class="reNavbar">
            <img src="<?php echo URLROOT; ?>/assets/images/hhlogo.png" alt="Health Hub Logo" class="relogo">
        
            <a href="<?php echo URLROOT; ?>/redashboard" class="reNavitems">Dashboard</a> 

            <?php if (isset($_SESSION['user'])): ?>
            <a href="#">
            <img src="<?php echo URLROOT .'/'.htmlspecialchars($_SESSION['user']['photo_path']) ?>" alt="User Icon" class="reloginlogo">
            <?php else: ?>
            <a>
            <img src="<?php echo URLROOT; ?>/assets/images/loginlogo.jpg" alt="User Icon" class="reloginlogo">
            <?php endif; ?>
            <!-- <a href="#" class="relogin">Receptionist</a> -->
            <?php if (isset($_SESSION['user'])): ?>
        <!-- User dropdown -->
        <div class="dropdown">


            <p class="username"><?php echo htmlspecialchars($_SESSION['user']['firstName']); ?></p>

            <div class="dropdown-content">
                <a href="<?php echo URLROOT; ?>/patientregister">Logout</a>
            </div>
        </div>
    <?php else: ?>
        <!-- Show "Login" link if no user is logged in -->
        <a href="<?php echo URLROOT; ?>/patientregister" class="login">Login</a>
    <?php endif; ?>
</div>
        </div>
</div>

