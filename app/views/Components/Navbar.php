<?php
// Start the session to enable session management
session_start();

// Logout functionality
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Unset all of the session variables
    $_SESSION = array();
    
    // Destroy the session
    session_destroy();
    
    // Redirect to the login page or homepage
    header("Location: " . URLROOT . "/patientregister");
    exit; // Ensure no further code is executed after redirect
}
?>

<div class="Navbar">
    <a href="#">
        <img src="<?php echo URLROOT; ?>/assets/images/logohealth.png" class="logo">
    </a>
    
    <a href="#" class="navitems">Home</a>
    <a href="#" class="navitems">Appointment</a>
    <a href="#" class="navitems">Inbox</a>

    <a href="#">
        <img src="<?php echo URLROOT; ?>/assets/images/loginlogo.jpg" class="loginlogo">
    </a>

    <?php if (isset($_SESSION['user'])): ?>
        <!-- User dropdown -->
        <div class="dropdown">
            <a href="#" class="logname dropdown-toggle">
                <?php echo htmlspecialchars($_SESSION['user']['FirstName']); ?>
            </a>
            <div class="dropdown-content">
                <a href="<?php echo URLROOT; ?>/patientprofile">Profile</a>
                <a href="?action=logout">Logout</a>
            </div>
        </div>
    <?php else: ?>
        <!-- Show "Login" link if no user is logged in -->
        <a href="<?php echo URLROOT; ?>/patientregister" class="login">Login</a>
    <?php endif; ?>
</div>