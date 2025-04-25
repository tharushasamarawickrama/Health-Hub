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

<div class="labNavbar">
            <img src="<?php echo URLROOT; ?>/assets/images/logohealth.png" alt="Health Hub Logo" class="lablogo">
            
            <a href="<?php echo URLROOT; ?>/labdashboard" class="labNavitems">Dashboard</a> 
            
            <?php if(isset($_SESSION['user'])): ?>
                <a href="#" class="logname dropdown-toggle">
                <img src="<?php echo URLROOT . '/' . htmlspecialchars($_SESSION['user']['photo_path']); ?>"  class="loginlogo"></a> 
            <?php else: ?>
                <img src="<?php echo URLROOT;?>/assets/images/loginlogo.jpg"  class="drloginlogo"> 
            <?php endif; ?>
            <?php if (isset($_SESSION['user'])): ?>
                <!-- User dropdown -->
                <div class="dropdown">
                    <p class="username"><?php echo htmlspecialchars($_SESSION['user']['firstName']); ?></p>
                    <div class="dropdown-content">
                        <a href="?action=logout">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="<?php echo URLROOT; ?>/patientregister" class="drlogin">Login</a>
            <?php endif; ?>
</div>
